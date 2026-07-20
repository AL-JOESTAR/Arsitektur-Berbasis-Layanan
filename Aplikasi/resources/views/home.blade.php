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
    padding-bottom:56px;
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

  /* ---------- TRUST LINE ---------- */
  .trust-line{
    border-top:1px solid var(--line);
    padding:26px 0;
  }
  .trust-line .wrap{
    display:flex; flex-wrap:wrap; align-items:center; justify-content:center;
    gap:14px 28px;
  }
  .trust-line span{
    font-family:'IBM Plex Mono', monospace; font-size:12px; letter-spacing:.06em;
    color:var(--ink-soft); display:flex; align-items:center; gap:14px;
  }
  .trust-line span b{ color:var(--moss); font-weight:600; }
  .trust-line .sep{
    width:4px; height:4px; border-radius:50%; background:var(--line); display:inline-block;
  }

  /* ---------- SECTION HEADER ---------- */
  .section{ padding:90px 0; }
  .section-head{ display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:50px; gap:24px; }
  .section-head h2{ font-size:clamp(28px,3.4vw,38px); font-weight:440; max-width:480px; line-height:1.18; }
  .section-head p{ color:var(--ink-soft); max-width:300px; font-size:14.5px; padding-bottom:4px; }

  /* ---------- KOS PILIHAN (listing + form sewa, scrollable) ---------- */
  .kos-section{ background:var(--paper-deep); }

  .kamar-scroll-hint{
    display:flex; align-items:center; gap:8px;
    font-family:'IBM Plex Mono', monospace; font-size:11.5px; letter-spacing:.06em;
    color:var(--ink-soft); margin-bottom:22px;
  }
  .kamar-scroll-hint svg{ width:14px; height:14px; }

  .kamar-scroll-outer{ position:relative; }
  .kamar-scroll-wrap{
    display:flex;
    gap:24px;
    overflow-x:auto;
    padding-bottom:18px;
    scroll-snap-type:x mandatory;
    scrollbar-width:thin;
    scrollbar-color:var(--brass) var(--paper);
  }
  .kamar-scroll-wrap::-webkit-scrollbar{ height:8px; }
  .kamar-scroll-wrap::-webkit-scrollbar-track{ background:var(--paper); border-radius:8px; }
  .kamar-scroll-wrap::-webkit-scrollbar-thumb{ background:var(--brass); border-radius:8px; }

  .kamar-slide{
    flex:0 0 320px;
    scroll-snap-align:start;
  }

  .kamar-scroll-outer::after{
    content:'';
    position:absolute;
    top:0; right:0; bottom:18px;
    width:60px;
    background:linear-gradient(to right, rgba(236,229,214,0), var(--paper-deep) 85%);
    pointer-events:none;
  }

  #kos .card{
    background:var(--white);
    border:1px solid var(--line);
    border-radius:4px;
    box-shadow:0 16px 34px -26px rgba(30,42,34,.35);
    height:100%;
  }
  #kos .card-title{
    font-family:'Fraunces', serif; font-size:20px; font-weight:560; color:var(--ink);
  }
  #kos hr{ border-color:var(--line); opacity:1; }
  #kos .badge.bg-success{ background:var(--moss) !important; border-radius:2px; font-weight:500; }
  #kos .text-success{ color:var(--moss) !important; }
  #kos .form-label{
    font-size:11.5px; text-transform:uppercase; letter-spacing:.06em; color:var(--ink-soft);
    font-family:'IBM Plex Mono', monospace; font-weight:500;
  }
  #kos .form-control, #kos .form-select{
    border-color:var(--line); border-radius:2px; font-size:14.5px;
  }
  #kos .form-control:focus, #kos .form-select:focus{
    border-color:var(--moss); box-shadow:0 0 0 3px rgba(47,74,62,.12);
  }
  #kos .alert-info{
    background:var(--paper); border:none; color:var(--ink-soft); border-radius:2px;
  }
  #kos .btn-success{
    background:var(--moss); border-color:var(--moss); border-radius:2px; font-weight:500;
    transition:background .2s ease;
  }
  #kos .btn-success:hover{ background:var(--ink); border-color:var(--ink); }

  /* ---------- KENAPA (steps) ---------- */
  .steps-section{
    background:#233830;
    color:var(--white);
    padding:90px 0;
  }
  .steps-eyebrow{
    font-family:'IBM Plex Mono', monospace; font-size:12px; letter-spacing:.18em; text-transform:uppercase;
    color:var(--brass-light); margin-bottom:18px; font-weight:500;
  }
  .steps-heading{
    font-family:'Fraunces', serif; font-weight:640; font-size:clamp(28px,3.6vw,42px);
    line-height:1.15; max-width:620px; margin-bottom:18px;
  }
  .steps-sub{
    color:rgba(243,239,230,.65); font-size:15.5px; max-width:480px; line-height:1.65; margin-bottom:64px;
  }
  .steps-row{
    position:relative;
    display:flex;
    justify-content:space-between;
    gap:12px;
  }
  .steps-row::before{
    content:'';
    position:absolute;
    top:27px;
    left:70px;
    right:70px;
    border-top:2px dashed rgba(184,137,91,.45);
    z-index:0;
  }
  .step{
    position:relative;
    z-index:1;
    flex:1;
    text-align:center;
    padding:0 18px;
  }
  .step-icon{
    width:56px; height:56px; border-radius:50%;
    background:#233830;
    border:1.5px solid var(--brass);
    display:flex; align-items:center; justify-content:center;
    margin:0 auto 26px;
    color:var(--brass-light);
  }
  .step-icon svg{ width:24px; height:24px; }
  .step h3{
    font-family:'Fraunces', serif; font-weight:600; font-size:17px;
    margin-bottom:10px; color:var(--white);
  }
  .step p{
    font-size:13.5px; color:rgba(243,239,230,.6); line-height:1.7;
    max-width:230px; margin:0 auto;
  }

  /* ---------- FITUR ---------- */
  .fitur-section{
    background:var(--white);
    padding:90px 0;
  }
  .fitur-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:24px;
  }
  .fitur-card{
    background:var(--paper);
    border:1px solid var(--line);
    border-radius:4px;
    padding:32px 28px;
    transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease;
  }
  .fitur-card:hover{
    transform:translateY(-5px);
    box-shadow:0 22px 40px -24px rgba(30,42,34,.25);
    border-color:var(--brass);
  }
  .fitur-icon{
    width:48px; height:48px; border-radius:12px;
    background:var(--brass-light);
    color:var(--jati);
    display:flex; align-items:center; justify-content:center;
    margin-bottom:20px;
  }
  .fitur-icon svg{ width:22px; height:22px; }
  .fitur-card h3{
    font-family:'Fraunces', serif; font-size:18px; font-weight:600;
    margin-bottom:8px; color:var(--ink);
  }
  .fitur-card p{
    font-size:13.5px; color:var(--ink-soft); line-height:1.65;
  }

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
  .reveal{ opacity:0; transform:translateY(18px); transition:opacity .7s ease, transform .7s ease; }
  .reveal.in{ opacity:1; transform:translateY(0); }

  /* ---------- RESPONSIVE ---------- */
  @media (max-width:880px){
    .nav-links, .hero-cta .btn-ghost{ display:none; }
    .hero-grid{ grid-template-columns:1fr; padding-bottom:40px; }
    .hero-art{ order:-1; }
    .kamar-slide{ flex-basis:82vw; }
    .steps-row{ flex-direction:column; gap:36px; }
    .steps-row::before{ display:none; }
    .step p{ max-width:100%; }
    .fitur-grid{ grid-template-columns:1fr; }
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
        <a href="#fitur">Fitur E-Kos</a>
        <a href="#kontak">Kontak</a>
      </div>
      <div style="display:flex; gap:12px;">
        <form method="POST" action="{{ url('/logout') }}">
        @csrf

        <button type="submit" class="btn btn-primary">
            Logout
        </button>
    </form>
      </div>
    </nav>
  </div>
</header>

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <div class="eyebrow"><span class="dash"></span>Welcome {{Auth::user()->name}}</div>
      <h1 class="headline">Kos yang terasa <em>seperti pulang</em>, bukan sekadar kamar sewa.</h1>
      <p class="lede">Tempat untuk beristirahat dengan tenang, memulai hari dengan nyaman, dan menikmati setiap momen layaknya di rumah sendiri.</p>
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

      <div class="floating-tag">
        <div class="tag-dot"></div>
        <div>
          <div class="t1">Tersedia 20 Kamar</div>
          <div class="t2 mono">SIAP HUNI KAPAN SAJA</div>
        </div>
      </div>
    </div>
  </div>

    <div class="trust-line">
    <div class="wrap">
      <span><b>100%</b> Kos Terverifikasi</span>
      <span class="sep"></span>
      <span><b>24/7</b>Keamanan & Akses</span>
      <span class="sep"></span>
      <span><b>4.8</b>/5 Rating Rata-rata</span>
    </div>
  </div>
</section>


<section class="section kos-section" id="kos">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Kos pilihan minggu ini.</h2>
      <p>Lebih dari sekadar nomor, setiap kamar dirancang untuk menghadirkan kenyamanan dengan nuansa yang berbeda.</p>
    </div>

    <div class="container-fluid mt-4 px-0">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="kamar-scroll-hint">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                Geser untuk lihat semua kamar yang tersedia
            </div>

            <div class="kamar-scroll-outer">
                <div class="kamar-scroll-wrap">

                @foreach($kamars as $kamar)

                    @if($kamar['status_kamar'] == 'Tersedia')

                    <div class="kamar-slide">

                        <div class="card shadow-sm h-100">

                            <div class="card-body">

                                <h5 class="card-title">
                                    Kamar {{ $kamar['Nomor_Kamar'] }}
                                </h5>

                                <hr>

                                <p>
                                    <strong>Harga / Bulan :</strong><br>
                                    <span class="text-success fw-bold">
                                        Rp {{ number_format($kamar['type_room']['price']) }}
                                    </span>
                                </p>

                                <p>
                                    <strong>Status :</strong>
                                    <span class="badge bg-success">
                                        {{ $kamar['status_kamar'] }}
                                    </span>
                                </p>

                                <form action="{{ url('/sewa') }}" method="POST">

                                    @csrf

                                    <input type="hidden"
                                        name="penyewa_id"
                                        value="{{ auth()->user()->id }}">

                                    <input type="hidden"
                                        name="kamar_id"
                                        value="{{ $kamar['id'] }}">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Tanggal Mulai
                                        </label>

                                        <input
                                            type="date"
                                            name="start"
                                            class="form-control"
                                            required>

                                    </div>

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Lama Sewa
                                        </label>

                                        <select
                                            name="periode"
                                            class="form-select"
                                            required>

                                            <option value="">-- Pilih Periode --</option>

                                            @for($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">
                                                    {{ $i }} Bulan
                                                </option>
                                            @endfor

                                        </select>

                                    </div>

                                    <div class="alert alert-info py-2">
                                        <small>
                                            Tanggal selesai akan dihitung otomatis sesuai periode yang dipilih.
                                        </small>
                                    </div>

                                    <button
                                        class="btn btn-success w-100"
                                        type="submit">

                                        Konfirmasi Sewa

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                    @endif

                @endforeach

                </div>
            </div>

</div>
  </div>
</section>

<section class="steps-section" id="kenapa">
  <div class="wrap">
    <div class="steps-eyebrow">Kenapa E-Kos</div>
    <h2 class="steps-heading">Sewa Kamar Dengan 3 Langkah</h2>
    <p class="steps-sub">Hanya dengan 3 langkah mudah, Anda sudah bisa mendapatkan kamar yang sesuai kebutuhan dan budget.  </p>

    <div class="steps-row">
      <div class="step">
        <div class="step-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v12l-4-2-3 2-3-2-4 2V6a2 2 0 012-2z"/></svg>
        </div>
        <h3>Pilih Kamar dan Layanan</h3>
        <p>Masukkan informasi yang diperlukan, pilih metode pembayaran yang tersedia, lalu konfirmasikan pesanan Anda dengan mudah.</p>
      </div>

      <div class="step">
        <div class="step-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 2L4 6v6c0 5 3.5 9 8 10 4.5-1 8-5 8-10V6l-8-4z"/></svg>
        </div>
        <h3>Isi Data & Bayar</h3>
        <p>Masukkan informasi yang diperlukan, pilih metode pembayaran yang tersedia, lalu konfirmasikan pesanan Anda dengan mudah.</p>
      </div>

      <div class="step">
        <div class="step-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 7l9-4 9 4-9 4-9-4zm0 5l9 4 9-4M3 17l9 4 9-4"/></svg>
        </div>
        <h3>Akun & Akses Langsung Aktif</h3>
        <p>Verifikasi pembayaran selesai, akun Anda akan otomatis aktif sehingga Anda dapat langsung mengakses layanan.</p>
      </div>
    </div>
  </div>
</section>

<section class="fitur-section" id="fitur">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Semua kebutuhan kos, dalam satu aplikasi.</h2>
      <p>Dari booking sampai akses pintu, semua bisa diatur langsung dari HP kamu.</p>
    </div>

    <div class="fitur-grid reveal">

      <div class="fitur-card">
        <div class="fitur-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M6 21V4.6c0-.55.42-1 .95-1.08l9-1.4A1 1 0 0117 3.1V21M6 21h11M6 21H4M17 21h2M13 12h.01"/></svg>
        </div>
        <h3>Booking Kamar Real-time</h3>
        <p>Lihat ketersediaan kamar, tipe, dan harga secara langsung tanpa perlu survei ke lokasi.</p>
      </div>

      <div class="fitur-card">
        <div class="fitur-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
        </div>
        <h3>Pembayaran Fleksibel</h3>
        <p>Nikmati proses pembayaran yang cepat, mudah, dan aman melalui Transfer Bank, E-Wallet, QRIS, atau Virtual Account.</p>
      </div>

      <div class="fitur-card">
        <div class="fitur-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><path d="M14 14h3v3h-3zM19 14h2v2h-2zM14 19h2v2h-2zM19 19h2v2h-2z"/></svg>
        </div>
        <h3>Pencatatan Akses dengan QR</h3>
        <p>Setiap penghuni mendapatkan QR pribadi untuk melakukan pencatatan keluar dan masuk secara praktis, lengkap dengan riwayat aktivitas.</p>
      </div>

      <div class="fitur-card">
        <div class="fitur-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg>
        </div>
        <h3>Laporan Kerusakan Online</h3>
        <p>Ada kendala di kamar? Laporkan langsung dari aplikasi, tim kami tindak lanjuti lebih cepat.</p>
      </div>

      <div class="fitur-card">
        <div class="fitur-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 13h6V4H4v9Zm0 7h6v-5H4v5Zm10 0h6V11h-6v9Zm0-16v5h6V4h-6Z"/></svg>
        </div>
        <h3>Dashboard Penyewa</h3>
        <p>Pantau status sewa, riwayat pembayaran, dan sisa masa kontrak dalam satu halaman.</p>
      </div>

      <div class="fitur-card">
        <div class="fitur-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
        </div>
        <h3>Notifikasi Otomatis</h3>
        <p>Dapat pengingat jatuh tempo, konfirmasi pembayaran, dan status laporan secara real-time.</p>
      </div>

    </div>
  </div>
</section>

<section class="cta-banner" id="kontak">
  <div class="wrap">
    <div class="eyebrow" style="justify-content:center;"><span class="dash"></span>Mulai Hari Ini<span class="dash"></span></div>
    <h2 class="display">Temukan tempat yang nyaman untuk pulang. Sewa kamar Anda sekarang dengan proses yang mudah dan praktis.</h2>
    <a class="btn btn-primary" href="#kos">Sewa Sekarang</a>
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
        <a href="#fitur">Fitur E-Kos</a>
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
      <span>{{ Auth::user()->name }}</span>
    </div>
  </div>

<script
    type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
</script>

        @if(session('snapToken'))
<script>
    window.snap.pay("{{ session('snapToken') }}", {

        onSuccess: function(result){
            alert("Pembayaran berhasil");
            console.log(result);

            window.location.href = "/dashboard";
        },

        onPending: function(result){
            alert("Menunggu pembayaran");
            console.log(result);
        },

        onError: function(result){
            alert("Pembayaran gagal");
            console.log(result);
        },

        onClose: function(){
            alert("Popup pembayaran ditutup.");
        }

    });
</script>
@endif

<script>
  const header = document.getElementById('siteHeader');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 10);
  });

  const revealEls = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
  }, { threshold: 0.15 });
  revealEls.forEach(el => io.observe(el));
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>