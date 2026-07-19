<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Kos — Hunian Kos Pilihan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,440;9..144,560;9..144,640&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#1E2A22;
    --ink-soft:#4B564E;
    --paper:#F3EFE6;
    --paper-deep:#ECE5D6;
    --moss:#2F4A3E;
    --moss-light:#4C6F5E;
    --brass:#B8895B;
    --brass-light:#E8C9A0;
    --line:#D9D2C0;
    --white:#FFFDF8;

    --jati:#8B5E3C;
    --cendana:#C98B5E;
    --mahoni:#7A3B2E;
    --saka:#5C6B4F;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{scroll-behavior:smooth;}
  body{
    font-family:'Inter', sans-serif;
    background:var(--paper);
    color:var(--ink);
    line-height:1.5;
    -webkit-font-smoothing:antialiased;
  }
  .display{ font-family:'Fraunces', serif; }
  .mono{ font-family:'IBM Plex Mono', monospace; letter-spacing:.06em; }
  a{color:inherit; text-decoration:none;}
  img,svg{display:block;}
  .wrap{ max-width:1180px; margin:0 auto; padding:0 32px; }
  ::selection{ background:var(--brass-light); color:var(--ink); }

  /* ---------- NAV ---------- */
  header{
    position:sticky; top:0; z-index:50;
    background:rgba(243,239,230,0.86);
    backdrop-filter:blur(10px);
    border-bottom:1px solid transparent;
    transition:border-color .3s ease, box-shadow .3s ease;
  }
  header.scrolled{ border-color:var(--line); box-shadow:0 8px 24px -16px rgba(30,42,34,.25); }
  nav{ display:flex; align-items:center; justify-content:space-between; padding:20px 0; }
  .logo{ display:flex; align-items:center; gap:10px; font-family:'Fraunces',serif; font-weight:560; font-size:22px; letter-spacing:.01em; }
  .logo-mark{ width:30px; height:30px; flex-shrink:0; }
  .nav-links{ display:flex; gap:36px; font-size:14.5px; color:var(--ink-soft); }
  .nav-links a{ position:relative; padding:4px 0; }
  .nav-links a::after{
    content:''; position:absolute; left:0; bottom:0; width:0; height:1px; background:var(--moss);
    transition:width .25s ease;
  }
  .nav-links a:hover{ color:var(--ink); }
  .nav-links a:hover::after{ width:100%; }
  .btn{
    display:inline-flex; align-items:center; gap:8px;
    font-size:14px; font-weight:500; padding:11px 22px;
    border-radius:2px; cursor:pointer; border:1px solid transparent;
    transition:transform .2s ease, background .2s ease, color .2s ease, border-color .2s ease;
  }
  .btn-primary{ background:var(--moss); color:var(--white); }
  .btn-primary:hover{ background:var(--ink); transform:translateY(-1px); }
  .btn-ghost{ border-color:var(--ink); color:var(--ink); }
  .btn-ghost:hover{ background:var(--ink); color:var(--white); }
  .menu-toggle{ display:none; }

  /* ---------- HERO ---------- */
  .hero{ position:relative; overflow:hidden; padding-top:64px; }
  .hero-grid{
    display:grid; grid-template-columns:1.05fr .95fr; gap:40px; align-items:center;
    padding-bottom:120px;
  }
  .eyebrow{
    font-family:'IBM Plex Mono', monospace; font-size:12px; letter-spacing:.18em; text-transform:uppercase;
    color:var(--moss); display:flex; align-items:center; gap:10px; margin-bottom:22px;
  }
  .eyebrow .dash{ width:28px; height:1px; background:var(--moss); display:block; }
  h1.headline{
    font-size:clamp(38px, 5vw, 60px); font-weight:440; line-height:1.06; letter-spacing:-.01em;
    color:var(--ink); max-width:560px;
  }
  h1.headline em{ font-style:italic; font-weight:300; color:var(--moss); }
  .hero p.lede{
    margin-top:24px; font-size:17px; color:var(--ink-soft); max-width:440px; line-height:1.7;
  }
  .hero-cta{ display:flex; gap:14px; margin-top:34px; }

  .hero-art{ position:relative; }
  .hero-art svg{ width:100%; height:auto; }

  /* floating key tag on hero art */
  .floating-tag{
    position:absolute; bottom:18px; left:-18px;
    background:var(--white); border:1px solid var(--line);
    padding:14px 18px; display:flex; align-items:center; gap:12px;
    box-shadow:0 18px 40px -20px rgba(30,42,34,.35);
    animation:float 5s ease-in-out infinite;
  }
  @keyframes float{ 0%,100%{ transform:translateY(0);} 50%{ transform:translateY(-9px);} }
  .tag-dot{ width:34px; height:34px; border-radius:50%; background:conic-gradient(from 200deg, var(--jati), var(--brass), var(--jati)); flex-shrink:0; }
  .floating-tag .t1{ font-size:13px; font-weight:600; }
  .floating-tag .t2{ font-size:11.5px; color:var(--ink-soft); }

  /* ---------- STAT STRIP ---------- */
  .stats{
    border-top:1px solid var(--line); border-bottom:1px solid var(--line);
    background:var(--paper-deep);
  }
  .stats .wrap{ display:grid; grid-template-columns:repeat(4,1fr); }
  .stat{ padding:30px 0; text-align:center; border-left:1px solid var(--line); }
  .stat:first-child{ border-left:none; }
  .stat .num{ font-family:'Fraunces',serif; font-size:30px; font-weight:560; color:var(--moss); }
  .stat .label{ font-size:12.5px; color:var(--ink-soft); margin-top:4px; letter-spacing:.02em; }

  /* ---------- SEARCH PANEL ---------- */
  .search-wrap{ margin-top:-70px; position:relative; z-index:10; padding-bottom:90px; }
  .search-panel{
    background:var(--white); border:1px solid var(--line);
    box-shadow:0 30px 60px -30px rgba(30,42,34,.3);
    padding:30px; display:grid; grid-template-columns:1fr 1fr 1fr auto; gap:22px; align-items:end;
  }
  .field label{ display:block; font-size:11.5px; text-transform:uppercase; letter-spacing:.1em; color:var(--ink-soft); margin-bottom:9px; font-family:'IBM Plex Mono', monospace;}
  .field select{
    width:100%; appearance:none; background:transparent; border:none; border-bottom:1px solid var(--line);
    padding:8px 0; font-size:16px; font-family:'Fraunces', serif; color:var(--ink); cursor:pointer;
  }
  .field select:focus{ outline:none; border-color:var(--moss); }
  .search-btn{ white-space:nowrap; padding:14px 30px; }

  /* ---------- SECTION HEADER ---------- */
  .section{ padding:90px 0; }
  .section-head{ display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:50px; gap:24px; }
  .section-head h2{ font-size:clamp(28px,3.4vw,38px); font-weight:440; max-width:480px; line-height:1.18; }
  .section-head p{ color:var(--ink-soft); max-width:300px; font-size:14.5px; padding-bottom:4px; }

  /* ---------- FEATURES ---------- */
  .features{ display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:var(--line); border:1px solid var(--line); }
  .feature{ background:var(--paper); padding:38px 32px; }
  .feature svg{ width:30px; height:30px; color:var(--moss); margin-bottom:22px; }
  .feature h3{ font-family:'Fraunces', serif; font-size:19px; font-weight:560; margin-bottom:10px; }
  .feature p{ font-size:14px; color:var(--ink-soft); line-height:1.65; }

  /* ---------- LISTING CARDS ---------- */
  .listing-grid{ display:grid; grid-template-columns:repeat(3,1fr); gap:28px; }
  .card{
    background:var(--white); border:1px solid var(--line);
    display:flex; flex-direction:column; overflow:hidden;
    transition:transform .35s ease, box-shadow .35s ease;
  }
  .card:hover{ transform:translateY(-6px); box-shadow:0 28px 50px -28px rgba(30,42,34,.35); }
  .card-art{ position:relative; height:190px; overflow:hidden; }
  .card-art .bg{ position:absolute; inset:0; }
  .card-art svg.room-icon{ position:absolute; right:18px; bottom:18px; width:46px; height:46px; opacity:.9; }
  .wood-tag{
    position:absolute; top:16px; left:16px; background:rgba(255,253,248,.92);
    padding:6px 12px; display:flex; align-items:center; gap:8px; font-size:11px;
  }
  .wood-swatch{ width:10px; height:10px; border-radius:50%; }
  .card-body{ padding:24px; display:flex; flex-direction:column; gap:10px; flex:1; }
  .card-body .loc{ font-size:12px; color:var(--ink-soft); display:flex; align-items:center; gap:6px; }
  .card-body h3{ font-family:'Fraunces', serif; font-size:21px; font-weight:560; }
  .amenities{ display:flex; flex-wrap:wrap; gap:8px; margin-top:2px; }
  .amenities span{ font-size:11px; color:var(--ink-soft); border:1px solid var(--line); padding:4px 9px; }
  .card-foot{
    margin-top:auto; padding-top:16px; border-top:1px solid var(--line);
    display:flex; align-items:baseline; justify-content:space-between;
  }
  .price{ font-family:'Fraunces',serif; font-size:19px; font-weight:560; color:var(--moss); }
  .price span{ font-family:'Inter',sans-serif; font-size:12px; color:var(--ink-soft); font-weight:400; }
  .card-foot a{ font-size:13px; font-weight:600; border-bottom:1px solid var(--ink); padding-bottom:2px; }

  /* ---------- TESTIMONIAL ---------- */
  .testi{ background:var(--moss); color:var(--white); }
  .testi .wrap{ padding:90px 32px; display:grid; grid-template-columns:.6fr 1fr; gap:50px; align-items:center; }
  .testi blockquote{ font-family:'Fraunces',serif; font-size:clamp(24px,2.8vw,32px); font-weight:300; font-style:italic; line-height:1.4; }
  .testi cite{ display:block; margin-top:26px; font-style:normal; font-size:14px; color:var(--brass-light); }
  .testi-mark{ font-family:'Fraunces',serif; font-size:120px; line-height:1; color:var(--moss-light); opacity:.6; }

  /* ---------- CTA BANNER ---------- */
  .cta-banner{ padding:100px 0; text-align:center; }
  .cta-banner h2{ font-size:clamp(30px,4vw,46px); font-weight:440; max-width:620px; margin:0 auto 28px; line-height:1.15; }
  .cta-banner .btn{ padding:15px 34px; font-size:15px; }

  /* ---------- FOOTER ---------- */
  footer{ background:var(--ink); color:var(--paper); padding:60px 0 28px; }
  .foot-grid{ display:grid; grid-template-columns:1.4fr 1fr 1fr 1fr; gap:40px; padding-bottom:40px; border-bottom:1px solid rgba(243,239,230,.15); }
  footer .logo{ color:var(--paper); }
  footer p.tag{ font-size:13.5px; color:#A9AFA6; margin-top:14px; max-width:240px; line-height:1.6; }
  .foot-col h4{ font-family:'IBM Plex Mono',monospace; font-size:11.5px; letter-spacing:.12em; text-transform:uppercase; color:#A9AFA6; margin-bottom:16px; }
  .foot-col a{ display:block; font-size:14px; color:#D9D8D0; margin-bottom:10px; }
  .foot-col a:hover{ color:var(--brass-light); }
  .foot-bottom{ display:flex; justify-content:space-between; padding-top:24px; font-size:12.5px; color:#7C8278; }

  /* ---------- REVEAL ---------- */
  .reveal{ opacity:1; transform:translateY(18px); transition:opacity .7s ease, transform .7s ease; }
  .reveal.in{ opacity:1; transform:translateY(0); }

  /* ---------- RESPONSIVE ---------- */
  @media (max-width:880px){
    .nav-links, .hero-cta .btn-ghost{ display:none; }
    .hero-grid{ grid-template-columns:1fr; padding-bottom:80px; }
    .hero-art{ order:-1; }
    .stats .wrap{ grid-template-columns:repeat(2,1fr); }
    .stat:nth-child(3){ border-left:none; }
    .search-panel{ grid-template-columns:1fr 1fr; }
    .search-btn{ grid-column:span 2; }
    .features{ grid-template-columns:1fr; }
    .listing-grid{ grid-template-columns:1fr; }
    .testi .wrap{ grid-template-columns:1fr; padding:60px 24px; }
    .testi-mark{ display:none; }
    .foot-grid{ grid-template-columns:1fr 1fr; }
    .wrap{ padding:0 20px; }
  }
</style>
</head>
<body>

<header id="siteHeader">
  <div class="wrap">
    <nav>
      <div class="logo">
        <svg class="logo-mark" viewBox="0 0 30 30" fill="none">
          <path d="M5 14L15 5L25 14V25H5V14Z" stroke="#2F4A3E" stroke-width="1.6" stroke-linejoin="round"/>
          <path d="M12 25V17H18V25" stroke="#B8895B" stroke-width="1.6"/>
        </svg>
        E-Kos
      </div>
      <div class="nav-links">
        <a href="#kos">Kos Pilihan</a>
        <a href="#kenapa">Kenapa E-Kos</a>
        <a href="#testimoni">Cerita Penghuni</a>
        <a href="#kontak">Kontak</a>
      </div>

      <div style="display:flex; gap:12px;">
    <nav class="d-flex gap-2">
        @auth
            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                Log in
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-primary">
                    Register
                </a>
            @endif
        @endauth
    </nav>
</div>
    </nav>
  </div>
</header>

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <div class="eyebrow"><span class="dash"></span>Welcome</div>
      <h1 class="headline">Kos yang terasa <em>seperti pulang</em>, bukan sekadar kamar sewa.</h1>
      <p class="lede">E-Kos memilihkan kos dengan tangan — pemilik yang ramah, kontrak yang jujur, dan kamar yang dirawat selayaknya rumah sendiri. Tinggal di 14 kota besar Indonesia.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="#kos">Lihat Kos Pilihan</a>
        <a class="btn btn-ghost" href="#kenapa">Bagaimana Cara Kerjanya</a>
      </div>
    </div>

    <div class="hero-art">
      <svg viewBox="0 0 480 420" xmlns="http://www.w3.org/2000/svg">
        <rect x="0" y="0" width="480" height="420" fill="none"/>
        <!-- floor plan grid -->
        <g opacity="0.5" stroke="#D9D2C0" stroke-width="1">
          <line x1="40" y1="0" x2="40" y2="420"/>
          <line x1="120" y1="0" x2="120" y2="420"/>
          <line x1="200" y1="0" x2="200" y2="420"/>
          <line x1="280" y1="0" x2="280" y2="420"/>
          <line x1="360" y1="0" x2="360" y2="420"/>
          <line x1="440" y1="0" x2="440" y2="420"/>
          <line x1="0" y1="40" x2="480" y2="40"/>
          <line x1="0" y1="120" x2="480" y2="120"/>
          <line x1="0" y1="200" x2="480" y2="200"/>
          <line x1="0" y1="280" x2="480" y2="280"/>
          <line x1="0" y1="360" x2="480" y2="360"/>
        </g>
        <!-- room block line art -->
        <rect x="80" y="70" width="320" height="280" fill="#ECE5D6" stroke="#2F4A3E" stroke-width="1.4"/>
        <!-- door -->
        <path d="M150 350 V250 A60 60 0 0 1 210 310" fill="none" stroke="#B8895B" stroke-width="2"/>
        <rect x="148" y="248" width="4" height="102" fill="#2F4A3E"/>
        <!-- bed -->
        <rect x="240" y="100" width="130" height="80" rx="4" fill="none" stroke="#2F4A3E" stroke-width="1.4"/>
        <rect x="240" y="100" width="40" height="80" rx="4" fill="#4C6F5E" opacity="0.5"/>
        <!-- desk -->
        <rect x="120" y="100" width="80" height="36" fill="none" stroke="#2F4A3E" stroke-width="1.4"/>
        <!-- window -->
        <rect x="240" y="220" width="120" height="60" fill="none" stroke="#2F4A3E" stroke-width="1.4"/>
        <line x1="300" y1="220" x2="300" y2="280" stroke="#2F4A3E" stroke-width="1.4"/>
        <line x1="240" y1="250" x2="360" y2="250" stroke="#2F4A3E" stroke-width="1.4"/>
        <!-- plant -->
        <circle cx="350" cy="320" r="3" fill="#5C6B4F"/>
        <path d="M350 320 C340 300 330 300 320 285 M350 320 C355 300 365 298 372 280 M350 320 C350 295 350 290 350 270" stroke="#5C6B4F" stroke-width="1.6" fill="none" stroke-linecap="round"/>
      </svg>

      <!-- <div class="floating-tag">
        <div class="tag-dot"></div>
        <div>
          <div class="t1">Kos Jati No. 12</div>
          <div class="t2 mono">SIAP HUNI · 1 JUL</div>
        </div> -->
      </div>
    </div>
  </div>
</section>

<!-- <section class="stats">
  <div class="wrap">
    <div class="stat"><div class="num display">186</div><div class="label">Kos Terverifikasi</div></div>
    <div class="stat"><div class="num display">14</div><div class="label">Kota di Indonesia</div></div>
    <div class="stat"><div class="num display">4.8</div><div class="label">Rating Rata-rata</div></div>
    <div class="stat"><div class="num display">2 jam</div><div class="label">Rata-rata Respon Survei</div></div>
  </div>
</section>

<div class="search-wrap">
  <div class="wrap">
    <div class="search-panel reveal">
      <div class="field">
        <label>Area</label>
        <select>
          <option>Pilih kota atau kawasan</option>
          <option>Jakarta Selatan</option>
          <option>Bandung Utara</option>
          <option>BSD City, Tangerang</option>
          <option>Yogyakarta</option>
        </select>
      </div>
      <div class="field">
        <label>Tipe Kamar</label>
        <select>
          <option>Semua tipe</option>
          <option>Kos Putri</option>
          <option>Kos Putra</option>
          <option>Kos Campur</option>
        </select>
      </div>
      <div class="field">
        <label>Anggaran / Bulan</label>
        <select>
          <option>Semua anggaran</option>
          <option>Rp 1 — 2 juta</option>
          <option>Rp 2 — 3,5 juta</option>
          <option>Rp 3,5 juta ke atas</option>
        </select>
      </div>
      <a class="btn btn-primary search-btn">Cari Kos</a>
    </div>
  </div>
</div> -->

<section class="section" id="kenapa">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Tiga hal yang membedakan E-Kos dari sekadar listing kos.</h2>
      <p>Bukan hanya foto bagus — kami yang turun langsung memastikan setiap kamar layak ditinggali.</p>
    </div>
    <div class="features reveal">
      <div class="feature">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v12l-4-2-3 2-3-2-4 2V6a2 2 0 012-2z"/></svg>
        <h3>Kontrak Jujur</h3>
        <p>Surat sewa berbahasa jelas, tanpa biaya tersembunyi. Apa yang disepakati di awal, itu yang dibayar.</p>
      </div>
      <div class="feature">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L4 6v6c0 5 3.5 9 8 10 4.5-1 8-5 8-10V6l-8-4z"/></svg>
        <h3>Pemilik Terverifikasi</h3>
        <p>Setiap pemilik kos kami temui langsung. Identitas dan legalitas bangunan diperiksa sebelum tayang.</p>
      </div>
      <div class="feature">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 7l9-4 9 4-9 4-9-4zm0 5l9 4 9-4M3 17l9 4 9-4"/></svg>
        <h3>Bantuan Pindahan</h3>
        <p>Tim E-kos membantu jadwal survei, negosiasi harga, hingga koordinasi pindahan di hari-H.</p>
      </div>
    </div>
  </div>
</section>

<section class="testi" id="testimoni">
  <div class="wrap">
    <div class="testi-mark">"</div>
    <div>
      <blockquote>Pindah ke Kos Saka itu satu-satunya keputusan tahun ini yang nggak pernah saya sesali. Pemiliknya sigap, dan suratnya benar-benar jelas — nggak ada drama di akhir bulan.</blockquote>
      <cite>Ranti A. — Penghuni Kos Saka, Bandung, sejak 2024</cite>
    </div>
  </div>
</section>

<section class="cta-banner" id="kontak">
  <div class="wrap">
    <div class="eyebrow" style="justify-content:center;"><span class="dash"></span>Mulai Hari Ini<span class="dash"></span></div>
    <h2 class="display">Survei kos pilihan Anda, tanpa biaya, kapan saja minggu ini.</h2>
    <a class="btn btn-primary">Jadwalkan Survei Gratis</a>
  </div>
</section>

<footer>
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <div class="logo">
          <svg class="logo-mark" viewBox="0 0 30 30" fill="none">
            <path d="M5 14L15 5L25 14V25H5V14Z" stroke="#F3EFE6" stroke-width="1.6" stroke-linejoin="round"/>
            <path d="M12 25V17H18V25" stroke="#B8895B" stroke-width="1.6"/>
          </svg>
          E-Kos
        </div>
        <p class="tag">Kos terkurasi untuk yang ingin tinggal dengan tenang — di 14 kota besar Indonesia.</p>
      </div>
      <div class="foot-col">
        <h4>Jelajahi</h4>
        <a href="#kos">Kos Pilihan</a>
        <a href="#kenapa">Kenapa E-Kos</a>
        <a href="#testimoni">Cerita Penghuni</a>
      </div>
      <div class="foot-col">
        <h4>Untuk Pemilik</h4>
        <a href="#">Daftarkan Kos</a>
        <a href="#">Panduan Pemilik</a>
      </div>
      <div class="foot-col">
        <h4>Kontak</h4>
        <a href="#">hello@E-Kos.id</a>
        <a href="#">+62 812 3456 7890</a>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© 2026 E-Kos Living. Seluruh hak cipta dilindungi.</span>
      <span>Jakarta, Indonesia</span>

    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

// locale_get_display_name
<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-4">

        <div class="w-full max-w-sm">

            {{-- TITLE --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    Login
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Masuk ke akun kamu
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- EMAIL --}}
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input
                            id="email"
                            type="email"
                            name="email"
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                            :value="old('email')"
                            required
                            autofocus
                            placeholder="email@domain.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input
                            id="password"
                            type="password"
                            name="password"
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900"
                            required
                            placeholder="••••••••"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- REMEMBER --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                            <span class="ml-2 text-gray-600 dark:text-gray-400">
                                Remember me
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                Forgot?
                            </a>
                        @endif
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="w-full bg-gray-900 text-white py-2.5 rounded-lg hover:bg-gray-800 transition">
                        Login
                    </button>

                </form>

            </div>

            {{-- FOOTER --}}
            <p class="text-center text-sm text-gray-500 mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-gray-900 font-medium hover:underline">
                    Register
                </a>
            </p>

        </div>

    </div>

</x-guest-layout>