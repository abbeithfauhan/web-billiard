# Quick Start Guide - Web Billiard Advanced Features

## Installation & Setup

### 1. Run Database Migrations
```bash
php artisan migrate
```

### 2. Seed Initial Player Stats (Optional)
```bash
php artisan db:seed --class=UserStatsSeeder
```

---

## Access Points

### Admin Player Management
```
URL: http://localhost:8000/admin/players
```

**Features:**
- View all players with rankings
- Edit individual player stats
- View player detail page with activities
- Bulk update capabilities

---

## How to Use Activity Logging

### In Your Controllers

**1. Booking Controller** - After creating a booking:
```php
use App\Services\ActivityService;

public function store(Request $request) {
    // Your booking creation logic
    $booking = Booking::create($validated);
    
    // Log the activity
    ActivityService::logBooking($request->user(), [
        'table_name' => $booking->table->name,
        'hours' => $booking->duration_hours,
    ]);
    
    return redirect()->route('booking.history');
}
```

**2. Tournament Controller** - On registration:
```php
public function register(Request $request, Tournament $tournament) {
    // Your registration logic
    $tournament->users()->attach($request->user());
    
    // Log the activity
    ActivityService::logTournamentRegistration($request->user(), [
        'tournament_name' => $tournament->name,
    ]);
    
    return redirect()->back()->with('success', 'Registered!');
}
```

**3. Auth Controller** - On successful login:
```php
use App\Services\ActivityService;

public function store(LoginRequest $request) {
    $request->authenticate();
    $request->session()->regenerate();
    
    // Log the login activity
    ActivityService::logLogin(auth()->user());
    
    return redirect()->intended(route('dashboard'));
}
```

**4. Match/Game Result** - On winning a game:
```php
public function recordWin(Request $request, $opponentId) {
    // Your game result logic
    
    ActivityService::logWin($request->user(), [
        'opponent' => User::find($opponentId)->name,
    ]);
    
    // Update stats
    $request->user()->stats()->increment('wins');
}
```

**5. Profile Update** - On profile changes:
```php
public function update(ProfileUpdateRequest $request) {
    // Your profile update logic
    $request->user()->update($validated);
    
    ActivityService::logProfileUpdate($request->user(), [
        'changes' => $validated,
    ]);
    
    return redirect()->back()->with('status', 'profile-updated');
}
```

---

## Dashboard Features

### Real Leaderboard
The dashboard now shows:
- **Top 3 Players** by ranking
- Real-time points and wins
- Fetched from `user_stats` table

### Real Activity Feed
The dashboard shows:
- **5 Most Recent Activities** system-wide
- Activity type, title, description
- Relative timestamps (e.g., "2 hours ago")
- Emoji icons for quick scanning

---

## Billiard Theme Styling

### CSS Classes Available

Add these classes to elements for billiard theme effects:

```html
<!-- Floating animations -->
<div class="billiard-ball-white">White Ball</div>
<div class="billiard-ball-black">Black Ball</div>
<div class="billiard-ball-stripe">Striped Ball</div>
<div class="billiard-ball-solid">Solid Ball</div>

<!-- Cue stick animation -->
<div class="billiard-queue">Cue Stick</div>

<!-- Decorative animations -->
<div class="billiard-element-pulse">Pulsing Element</div>
<div class="billiard-glow">Glowing Element</div>
<div class="billiard-drift">Drifting Element</div>

<!-- Backgrounds -->
<section class="billiard-pattern">Pattern Background</section>
<section class="billiard-stripes">Striped Background</section>
```

---

## Admin Routes

### Player Management Routes

```
GET     /admin/players              - List all players
GET     /admin/players/create       - Create new player (if needed)
POST    /admin/players              - Store new player (if needed)
GET     /admin/players/{id}         - View player detail
GET     /admin/players/{id}/edit    - Edit player form
PUT     /admin/players/{id}         - Update player
DELETE  /admin/players/{id}         - Delete player
POST    /admin/players/bulk-update  - Bulk update multiple
```

---

## Testing the Features

### Test Admin Panel
1. Login as admin
2. Navigate to `/admin/players`
3. Click on a player to edit
4. Update their stats and save
5. View detail page to see activities

### Test Activity Logging
1. Create a booking → activity logged
2. Register for tournament → activity logged
3. Check dashboard → new activity appears
4. Check player detail page → activity in timeline

### Test Billiard Theme
1. Visit landing page
2. Scroll down to see animations
3. Inspect: Floating balls, cue stick, patterns
4. Resize browser → responsive animations
5. Open in different browser → cross-browser compatible

---

## Database Tables Overview

### user_stats
```
id              : integer (primary key)
user_id         : integer (unique, foreign key)
wins            : integer (default 0)
losses          : integer (default 0)
draws           : integer (default 0)
points          : integer (default 0)
ranking         : integer (default 0)
tournaments_participated : integer (default 0)
total_bookings  : integer (default 0)
total_hours_played : float (default 0)
created_at      : timestamp
updated_at      : timestamp
```

### activities
```
id              : integer (primary key)
user_id         : integer (foreign key)
type            : string (booking|tournament|profile|payment|win|login)
title           : string
description     : text (nullable)
data            : json (nullable)
created_at      : timestamp
updated_at      : timestamp
```

---

## Common Tasks

### Add New Activity Type

1. **In ActivityService** (`app/Services/ActivityService.php`):
```php
public static function logCustomAction(User $user, $customData = null) {
    Activity::log(
        $user->id,
        'custom_action',  // NEW TYPE
        'Custom Action Title',
        'Custom action description',
        $customData
    );
}
```

2. **In Activity Model** (`app/Models/Activity.php`):
```php
public function getActivityIcon() {
    return match ($this->type) {
        'booking' => '📅',
        'tournament' => '🏆',
        'custom_action' => '🆕',  // ADD ICON
        // ... rest of types
        default => '📌',
    };
}
```

3. **Call in Controller**:
```php
ActivityService::logCustomAction($user, $data);
```

### Display Activities in Other Views

```php
// Get user's activities
$activities = $user->activities()->latest()->limit(5)->get();

// Get all recent activities
$allActivities = Activity::latest()->limit(10)->get();

// Filter by type
$bookings = $user->activities()
    ->where('type', 'booking')
    ->latest()
    ->limit(5)
    ->get();
```

### Update Player Stats

```php
$user = User::find(1);

$user->stats()->update([
    'wins' => 50,
    'losses' => 10,
    'points' => 5000,
    'ranking' => 1,
]);
```

---

## Troubleshooting

### Issue: 404 on `/admin/players`
**Solution**: 
- Verify you're logged in as admin
- Check `auth` and `admin` middleware in routes
- Ensure user role is set to 'admin'

### Issue: Migrations fail
**Solution**:
```bash
# Reset and re-run
php artisan migrate:reset
php artisan migrate
```

### Issue: Seeder not working
**Solution**:
```bash
# Check seeder file exists
php artisan db:seed --class=UserStatsSeeder --verbose
```

### Issue: Activities not showing
**Solution**:
- Ensure `ActivityService::log*()` is called
- Check database has records
- Verify relationships in models
- Check timestamps are correct

---

## Performance Tips

1. **Queries are indexed** on ranking, points, user_id, type, created_at
2. **Pagination enabled** on admin players list (15 per page)
3. **CSS animations use GPU** (transform, opacity only)
4. **Dashboard limits queries** (3 top players, 5 activities)

---

## Next Steps

1. ✅ Run migrations
2. ✅ (Optional) Seed data
3. ✅ Add ActivityService calls to controllers
4. ✅ Test admin panel
5. ✅ Test activity logging
6. ✅ Deploy to production

---

**Last Updated**: 28 Juni 2026
**Version**: 1.0.0

