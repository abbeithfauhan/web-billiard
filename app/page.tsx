import Link from 'next/link'
import { ArrowRight, Zap, Globe, Palette } from 'lucide-react'

export default function Page() {
  return (
    <div className="min-h-screen bg-gradient-to-br from-background via-background to-slate-50">
      {/* Header Navigation */}
      <header className="sticky top-0 z-50 border-b border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
        <nav className="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
          <div className="flex items-center gap-2">
            <div className="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-primary to-accent">
              <span className="text-sm font-bold text-white">V</span>
            </div>
            <span className="text-lg font-bold text-foreground">Vision</span>
          </div>
          <div className="hidden items-center gap-8 md:flex">
            <Link href="#features" className="text-sm font-medium text-foreground/70 transition-colors hover:text-foreground">
              Fitur
            </Link>
            <Link href="#showcase" className="text-sm font-medium text-foreground/70 transition-colors hover:text-foreground">
              Showcase
            </Link>
            <Link href="#contact" className="text-sm font-medium text-foreground/70 transition-colors hover:text-foreground">
              Hubungi Kami
            </Link>
          </div>
          <button className="hidden rounded-lg bg-primary px-6 py-2 text-sm font-semibold text-primary-foreground transition-all hover:shadow-lg hover:shadow-primary/30 md:block">
            Mulai Sekarang
          </button>
        </nav>
      </header>

      {/* Hero Section */}
      <section className="relative overflow-hidden px-4 py-20 sm:px-6 lg:px-8">
        <div className="mx-auto max-w-7xl">
          {/* Decorative background elements */}
          <div className="absolute inset-0 -z-10 overflow-hidden">
            <div className="absolute -left-1/4 -top-1/4 h-1/2 w-1/2 rounded-full bg-gradient-to-br from-primary/10 to-transparent blur-3xl"></div>
            <div className="absolute -right-1/4 -bottom-1/4 h-1/2 w-1/2 rounded-full bg-gradient-to-tl from-accent/10 to-transparent blur-3xl"></div>
          </div>

          <div className="grid gap-12 lg:grid-cols-2 lg:gap-8 items-center">
            {/* Left Content */}
            <div className="space-y-8">
              <div className="space-y-4">
                <div className="inline-block rounded-full bg-primary/10 px-4 py-1.5">
                  <span className="text-sm font-semibold text-primary">✨ Inovasi Terdepan</span>
                </div>
                <h1 className="text-4xl font-bold tracking-tight text-foreground sm:text-5xl lg:text-6xl">
                  Desain Web yang
                  <span className="block bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                    Memukau
                  </span>
                </h1>
                <p className="text-lg text-foreground/70 leading-relaxed max-w-xl">
                  Ciptakan pengalaman web yang luar biasa dengan design system modern kami. Sempurna untuk startup hingga enterprise.
                </p>
              </div>

              <div className="flex flex-col gap-4 sm:flex-row">
                <button className="rounded-lg bg-primary px-8 py-3 font-semibold text-primary-foreground transition-all hover:shadow-lg hover:shadow-primary/30 flex items-center justify-center gap-2">
                  Coba Sekarang
                  <ArrowRight className="h-4 w-4" />
                </button>
                <button className="rounded-lg border border-border px-8 py-3 font-semibold text-foreground transition-all hover:bg-muted">
                  Lihat Demo
                </button>
              </div>

              <div className="flex flex-wrap gap-6 pt-4">
                {['TypeScript', 'React', 'Tailwind'].map((tech) => (
                  <div key={tech} className="flex items-center gap-2 text-sm text-foreground/60">
                    <div className="h-2 w-2 rounded-full bg-primary"></div>
                    {tech}
                  </div>
                ))}
              </div>
            </div>

            {/* Right Visual */}
            <div className="relative h-96 md:h-full min-h-96">
              <div className="absolute inset-0 rounded-2xl bg-gradient-to-br from-primary/20 to-accent/20 backdrop-blur-sm"></div>
              <div className="absolute inset-0 flex items-center justify-center">
                <div className="text-center">
                  <div className="mb-4 inline-block rounded-lg bg-gradient-to-br from-primary to-accent p-4">
                    <Zap className="h-12 w-12 text-white" />
                  </div>
                  <p className="text-xl font-bold text-foreground">Siap Dikembangkan</p>
                  <p className="text-sm text-foreground/60 mt-2">Mulai dengan template premium</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section id="features" className="px-4 py-20 sm:px-6 lg:px-8 bg-muted/30">
        <div className="mx-auto max-w-7xl">
          <div className="text-center space-y-4 mb-16">
            <h2 className="text-3xl font-bold text-foreground sm:text-4xl">Fitur Unggulan</h2>
            <p className="text-lg text-foreground/70 max-w-2xl mx-auto">
              Semua yang Anda butuhkan untuk membangun website modern dan profesional
            </p>
          </div>

          <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            {[
              {
                icon: Zap,
                title: 'Lightning Fast',
                description: 'Performa optimal dengan loading time super cepat',
              },
              {
                icon: Globe,
                title: 'Global Ready',
                description: 'Deploy ke seluruh dunia dalam hitungan detik',
              },
              {
                icon: Palette,
                title: 'Fully Customizable',
                description: 'Sesuaikan setiap detail sesuai brand Anda',
              },
              {
                icon: Zap,
                title: 'Dark Mode',
                description: 'Dukungan penuh untuk dark dan light theme',
              },
              {
                icon: Globe,
                title: 'SEO Optimized',
                description: 'Ranking tinggi di search engine sejak awal',
              },
              {
                icon: Palette,
                title: 'Mobile First',
                description: 'Sempurna di semua ukuran layar dan device',
              },
            ].map((feature, idx) => {
              const Icon = feature.icon
              return (
                <div
                  key={idx}
                  className="group relative rounded-xl border border-border bg-background p-6 transition-all hover:shadow-lg hover:border-primary/50"
                >
                  <div className="absolute inset-0 rounded-xl bg-gradient-to-br from-primary/5 to-accent/5 opacity-0 transition-opacity group-hover:opacity-100"></div>
                  <div className="relative space-y-4">
                    <div className="inline-block rounded-lg bg-primary/10 p-3">
                      <Icon className="h-6 w-6 text-primary" />
                    </div>
                    <div>
                      <h3 className="font-semibold text-foreground">{feature.title}</h3>
                      <p className="text-sm text-foreground/60 mt-1">{feature.description}</p>
                    </div>
                  </div>
                </div>
              )
            })}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section id="contact" className="px-4 py-20 sm:px-6 lg:px-8">
        <div className="mx-auto max-w-4xl">
          <div className="relative rounded-2xl border border-primary/20 bg-gradient-to-br from-primary/10 to-accent/10 p-12 text-center">
            <div className="space-y-6">
              <h2 className="text-3xl font-bold text-foreground sm:text-4xl">Siap Memulai?</h2>
              <p className="text-lg text-foreground/70 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan developer yang telah membuat website amazing dengan platform kami
              </p>
              <div className="flex gap-4 justify-center flex-wrap">
                <button className="rounded-lg bg-primary px-8 py-3 font-semibold text-primary-foreground transition-all hover:shadow-lg hover:shadow-primary/30">
                  Mulai Gratis
                </button>
                <button className="rounded-lg border border-primary px-8 py-3 font-semibold text-primary transition-all hover:bg-primary/5">
                  Hubungi Sales
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="border-t border-border/40 bg-muted/20 px-4 py-12 sm:px-6 lg:px-8">
        <div className="mx-auto max-w-7xl">
          <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <div>
              <h4 className="font-semibold text-foreground mb-4">Produk</h4>
              <ul className="space-y-2 text-sm text-foreground/70">
                <li><Link href="#" className="hover:text-foreground">Fitur</Link></li>
                <li><Link href="#" className="hover:text-foreground">Pricing</Link></li>
                <li><Link href="#" className="hover:text-foreground">Security</Link></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold text-foreground mb-4">Komunitas</h4>
              <ul className="space-y-2 text-sm text-foreground/70">
                <li><Link href="#" className="hover:text-foreground">Discord</Link></li>
                <li><Link href="#" className="hover:text-foreground">Twitter</Link></li>
                <li><Link href="#" className="hover:text-foreground">GitHub</Link></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold text-foreground mb-4">Perusahaan</h4>
              <ul className="space-y-2 text-sm text-foreground/70">
                <li><Link href="#" className="hover:text-foreground">Tentang</Link></li>
                <li><Link href="#" className="hover:text-foreground">Blog</Link></li>
                <li><Link href="#" className="hover:text-foreground">Karir</Link></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold text-foreground mb-4">Legal</h4>
              <ul className="space-y-2 text-sm text-foreground/70">
                <li><Link href="#" className="hover:text-foreground">Privacy</Link></li>
                <li><Link href="#" className="hover:text-foreground">Terms</Link></li>
                <li><Link href="#" className="hover:text-foreground">Contact</Link></li>
              </ul>
            </div>
          </div>
          <div className="border-t border-border/40 pt-8 flex items-center justify-between flex-col sm:flex-row gap-4">
            <p className="text-sm text-foreground/60">© 2026 Vision. All rights reserved.</p>
            <div className="flex gap-4">
              <Link href="#" className="text-foreground/60 hover:text-foreground">Twitter</Link>
              <Link href="#" className="text-foreground/60 hover:text-foreground">GitHub</Link>
              <Link href="#" className="text-foreground/60 hover:text-foreground">LinkedIn</Link>
            </div>
          </div>
        </div>
      </footer>
    </div>
  )
}
