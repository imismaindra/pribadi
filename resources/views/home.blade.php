@extends('layouts.app')

@section('title', 'Maulana Ismaindra — Full-Stack Developer')

@section('content')

<div class="container">

    {{-- HERO --}}
   <div class="container">
      <div class="eyebrow mono">
        <span>Portfolio / 2026</span>
        <span>Full-Stack Developer</span>
      </div>

      <section class="hero">
        <div class="hero-copy reveal">
          <div class="hero-number mono">01 — Introduction</div>

          <h1>
            <span>MAULANA</span>
            <span><em>ISMAINDRA</em></span>
          </h1>

          <p class="hero-description">
            I design, develop, and maintain
            <strong>websites and web-based systems</strong>
            built for real-world use — from content platforms
            and academic systems to commerce and internal tools.
          </p>
        </div>

        <div class="portrait-wrap reveal">
          <div class="portrait">
            <!-- Dummy portrait. Replace this URL later with your real photo. -->
            <img
              src="{{ asset('images/profile.webp') }}"
              alt="Maulana Ismaindra Portrait"
            />
            <div class="portrait-label mono">Portrait / Placeholder</div>
          </div>

          <div class="portrait-index mono">INDONESIA / 2026</div>

          <div class="availability mono">
            <span><i class="dot"></i>Available for selected projects</span>
            <span>↘</span>
          </div>
        </div>
      </section>

      <div class="index reveal">
        <div class="index-title mono">Currently working with</div>
        <div class="stack-list">
          <span>Laravel</span>
          <span>Next.js</span>
          <span>React</span>
          <span>Node.js</span>
          <span>MySQL</span>
          <span>Prisma</span>
          <span>Tailwind</span>
          <span>JavaScript</span>
        </div>
      </div>

      <!-- WORK -->
      <section id="work">
        <div class="section-head reveal">
          <div class="section-number mono">02 — Selected Work</div>
          <h2 class="section-title">Things I <em>build.</em></h2>
        </div>

        <div class="featured">

            @foreach($featuredProjects as $index => $project)

                <article class="project reveal">

                    <div class="project-meta mono">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}<br><br>
                        {{ $project->year }}<br>
                        {{ strtoupper($project->category) }}
                    </div>

                    <div class="project-main">

                        <div class="project-top">
                            <h3>{{ $project->title }}</h3>

                            <div class="project-type mono">
                                {{ $project->category }}
                            </div>
                        </div>

                        @if($project->thumbnail)
                            <a
                                href="{{ $project->live_url ?? '#' }}"
                                class="project-image magnetic"
                                @if($project->live_url) target="_blank" @endif
                            >
                                <img
                                    src="{{ asset('storage/' . $project->thumbnail) }}"
                                    alt="{{ $project->title }}"
                                >
                            </a>
                        @endif

                        <div class="project-caption mono">

                            <span>
                                {{ implode(' · ', $project->technologies ?? []) }}
                            </span>

                            @if($project->live_url)
                                <span>Visit website ↗</span>
                            @else
                                <span>View case study ↗</span>
                            @endif

                        </div>

                    </div>

                </article>

            @endforeach

        </div>
      </section>

      <!-- ARCHIVE -->
      <section>
        <div class="section-head reveal">
          <div class="section-number mono">03 — Archive</div>
          <h2 class="section-title">More <em>work.</em></h2>
        </div>

        <div class="archive reveal">

          @foreach($projects->where('featured', false) as $project)

              <a
                  class="archive-row"
                  href="{{ $project->live_url ?? '#' }}"
                  @if($project->live_url)
                      target="_blank"
                      rel="noopener noreferrer"
                  @endif
              >
                  <span class="archive-year mono">
                      {{ $project->year ?? '—' }}
                  </span>

                  <span class="archive-name">
                      {{ $project->title }}
                  </span>

                  <span class="archive-type mono">
                      {{ strtoupper($project->category) }}
                  </span>

                  <span class="archive-arrow">
                      ↗
                  </span>
              </a>

          @endforeach

      </div>
      </section>

      <!-- ABOUT -->
      <section id="about">
        <div class="section-head reveal">
          <div class="section-number mono">04 — About</div>
          <h2 class="section-title">Not just <em>web pages.</em></h2>
        </div>

        <div class="about-grid">
          <div class="mono section-number">Profile</div>

          <div class="about-content reveal">
            <p class="about-lead">
              I build <em>digital systems</em> that solve practical problems.
            </p>

            <div class="about-text">
              <p>
                My focus is full-stack development — turning ideas,
                workflows, and business requirements into usable web
                applications.
              </p>

              <p>
                I care about the parts that are often invisible:
                authentication, data flow, maintainability, performance,
                responsive interfaces, and the experience after launch.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- STACK -->
      <section id="stack">
        <div class="section-head reveal">
          <div class="section-number mono">05 — Technology</div>
          <h2 class="section-title">The <em>stack.</em></h2>
        </div>

        <div class="tech-grid reveal">
          <div class="tech-row">
            <h3>01 / Frontend</h3>
            <div class="tech-items">
              <span>React</span>
              <span>Next.js</span>
              <span>Vue</span>
              <span>Tailwind CSS</span>
              <span>JavaScript</span>
            </div>
          </div>

          <div class="tech-row">
            <h3>02 / Backend</h3>
            <div class="tech-items">
              <span>Laravel</span>
              <span>Node.js</span>
              <span>PHP</span>
              <span>Express</span>
            </div>
          </div>

          <div class="tech-row">
            <h3>03 / Database</h3>
            <div class="tech-items">
              <span>MySQL</span>
              <span>Prisma</span>
              <span>SQLite</span>
            </div>
          </div>

          <div class="tech-row">
            <h3>04 / Mobile</h3>
            <div class="tech-items">
              <span>React Native</span>
              <span>Expo</span>
            </div>
          </div>

          <div class="tech-row">
            <h3>05 / Other</h3>
            <div class="tech-items">
              <span>Python</span>
              <span>TensorFlow</span>
              <span>Git</span>
              <span>Botpress</span>
            </div>
          </div>
        </div>
      </section>

      <!-- EXPERIENCE -->
      <section id="experience">
        <div class="section-head reveal">
          <div class="section-number mono">06 — Experience</div>
          <h2 class="section-title">Where I've <em>worked.</em></h2>
        </div>

        <div class="timeline reveal">
          <div class="timeline-item">
            <div class="timeline-date mono">2021 — 2023</div>
            <div>
              <h3 class="timeline-role">Web &amp; AI Chatbot Developer</h3>
              <div class="timeline-place">PT. Universal Big Data</div>
            </div>
            <p class="timeline-desc">
              Developed web applications, chatbot systems, and internal
              digital tools. Also involved in chatbot training and implementation.
            </p>
          </div>

          <div class="timeline-item">
            <div class="timeline-date mono">2023 — Present</div>
            <div>
              <h3 class="timeline-role">Informatics Engineering</h3>
              <div class="timeline-place">ITATS</div>
            </div>
            <p class="timeline-desc">
              Building academic and independent software projects while
              exploring full-stack development, system design, and product-oriented development.
            </p>
          </div>

          <div class="timeline-item">
            <div class="timeline-date mono">Present</div>
            <div>
              <h3 class="timeline-role">Independent Developer</h3>
              <div class="timeline-place">Indonesia</div>
            </div>
            <p class="timeline-desc">
              Developing websites, management systems, content platforms,
              and digital products for practical use.
            </p>
          </div>
        </div>
      </section>

      <!-- CONTACT -->
      <section id="contact" class="contact">
        <div class="contact-box reveal">
          <div class="mono section-number">07 — Contact</div>

          <h2 class="contact-title">
            Have a system<br>
            worth <em>building?</em>
          </h2>

          <div class="contact-bottom">
            <a class="email magnetic" href="mailto:hello@ismaindra.web.id">
              hello@ismaindra.web.id ↗
            </a>

            <div class="socials mono">
              <a href="https://github.com/imismaindra" target="_blank">GitHub</a>
              <a href="https://www.linkedin.com/in/ismaindra/" target="_blank">LinkedIn</a>
              <a href="https://www.instagram.com/imismaindra/" target="_blank">Instagram</a>
            </div>
          </div>
        </div>
      </section>

</div>

@endsection