<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!--
	NOTE FOR INTEGRATION:
	This view is included inside your existing layout, which owns <head>/<title>.
	Personalized title to set there:

		Miko Joshua Dela Cruz — 3F1 Mayor & IT Student | Access Terminal
-->
<style>
	:root{
		--bg:#0a0f1c;
		--surface:#131b2e;
		--bg-elevated:#0f1526;
		--border:#243149;
		--border-soft:#1c2740;
		--text:#e9edf7;
		--text-dim:#96a1b8;
		--text-mute:#5c6883;
		--cyan:#2ee6d6;
		--cyan-dim:#1a9c91;
		--amber:#f4b942;
		--font-display:'Space Grotesk', 'Segoe UI', sans-serif;
		--font-body:'Inter', 'Segoe UI', sans-serif;
		--font-mono:'JetBrains Mono', 'Consolas', monospace;
	}

	@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap');

	html, body{
		margin:0;
		padding:0;
		background:var(--bg);
	}

	.stp-root{
		position:relative;
		font-family:var(--font-body);
		background:
			radial-gradient(circle at 20% 10%, rgba(46,230,214,0.07), transparent 45%),
			var(--bg);
		color:var(--text);
		min-height:100vh;
		padding:32px 20px 70px;
		box-sizing:border-box;
		overflow:hidden;
		isolation:isolate;
	}
	.stp-root *{ box-sizing:border-box; }

	/* ---------- Ambient background layer ---------- */
	.stp-bg{
		position:absolute;
		inset:0;
		z-index:-1;
		pointer-events:none;
		background-image:
			linear-gradient(rgba(46,230,214,0.05) 1px, transparent 1px),
			linear-gradient(90deg, rgba(46,230,214,0.05) 1px, transparent 1px);
		background-size:42px 42px;
		mask-image:radial-gradient(ellipse 70% 55% at 50% 20%, #000 40%, transparent 90%);
		-webkit-mask-image:radial-gradient(ellipse 70% 55% at 50% 20%, #000 40%, transparent 90%);
	}
	.stp-orb{
		position:absolute;
		border-radius:50%;
		filter:blur(60px);
		z-index:-1;
		pointer-events:none;
		opacity:.55;
	}
	.stp-orb-cyan{
		width:320px; height:320px;
		background:radial-gradient(circle, rgba(46,230,214,0.35), transparent 70%);
		top:-90px; right:-60px;
		animation:stp-float 9s ease-in-out infinite;
	}
	.stp-orb-amber{
		width:260px; height:260px;
		background:radial-gradient(circle, rgba(244,185,66,0.28), transparent 70%);
		bottom:60px; left:-80px;
		animation:stp-float 11s ease-in-out infinite reverse;
	}
	.stp-glyph{
		position:absolute;
		font-family:var(--font-mono);
		color:var(--border);
		z-index:-1;
		pointer-events:none;
		user-select:none;
	}
	.stp-glyph-1{ top:18px; right:6%; font-size:2.6rem; opacity:.5; animation:stp-bob 6s ease-in-out infinite; }
	.stp-glyph-2{ bottom:10%; right:4%; font-size:1.1rem; opacity:.4; animation:stp-bob 7.5s ease-in-out infinite .5s; }

	/* ---------- Nav ---------- */
	.stp-nav{
		max-width:720px;
		margin:0 auto 34px;
		display:flex;
		align-items:center;
		justify-content:space-between;
		flex-wrap:wrap;
		gap:10px;
		opacity:0;
		animation:stp-drop .55s ease forwards;
	}
	.stp-nav-brand{
		font-family:var(--font-mono);
		font-size:.78rem;
		letter-spacing:.12em;
		text-transform:uppercase;
		color:var(--text-mute);
		display:flex;
		align-items:center;
		gap:8px;
	}
	.stp-nav-brand-dot{
		width:6px; height:6px; border-radius:50%;
		background:#4ade80;
		box-shadow:0 0 0 0 rgba(74,222,128,0.6);
		animation:stp-pulse 1.8s ease-out infinite;
	}
	.stp-nav-links a{
		font-family:var(--font-mono);
		font-size:.82rem;
		color:var(--text-dim);
		text-decoration:none;
		margin-left:20px;
		position:relative;
		padding-bottom:4px;
		transition:color .25s ease;
	}
	.stp-nav-links a::after{
		content:'';
		position:absolute; left:0; bottom:0;
		width:0; height:1px;
		background:var(--cyan);
		transition:width .25s ease;
	}
	.stp-nav-links a:hover{ color:var(--text); }
	.stp-nav-links a:hover::after{ width:100%; }

	/* ---------- Hero ---------- */
	.stp-hero{
		max-width:720px;
		margin:0 auto 20px;
		opacity:0;
		animation:stp-rise .6s ease .08s forwards;
	}
	.stp-hero-eyebrow{
		display:inline-flex;
		align-items:center;
		gap:7px;
		font-family:var(--font-mono);
		font-size:.7rem;
		letter-spacing:.14em;
		text-transform:uppercase;
		color:var(--cyan);
		border:1px solid var(--cyan-dim);
		background:rgba(46,230,214,0.07);
		padding:5px 11px;
		border-radius:999px;
		margin-bottom:14px;
	}
	.stp-hero h1{
		font-family:var(--font-display);
		font-weight:700;
		font-size:clamp(1.6rem, 4.2vw, 2.15rem);
		margin:0 0 8px;
		letter-spacing:.01em;
	}
	.stp-hero-sub{
		font-size:.92rem;
		color:var(--text-dim);
		margin:0 0 4px;
	}
	/* ---------- Console message component (HUD framed) ----------
	   Deliberately distinct from the profile's rounded ID-badge card:
	   flatter corners, dashed rule, terminal chrome dots, monospace
	   output line with a blinking cursor, corner brackets for a HUD
	   feel. Same color/type tokens as the profile page keep it part
	   of the same family. */
	.stp-console-wrap{
		max-width:720px;
		margin:0 auto;
		position:relative;
		padding:14px;
		opacity:0;
		animation:stp-rise .6s ease .2s forwards;
	}
	.stp-console-wrap::before,
	.stp-console-wrap::after,
	.stp-console-wrap .stp-corner-tr,
	.stp-console-wrap .stp-corner-br{
		content:'';
		position:absolute;
		width:16px; height:16px;
		border:1.5px solid var(--cyan-dim);
		opacity:.6;
	}
	.stp-console-wrap::before{ top:0; left:0; border-right:none; border-bottom:none; }
	.stp-console-wrap::after{ bottom:0; left:0; border-right:none; border-top:none; }
	.stp-console-wrap .stp-corner-tr{ top:0; right:0; border-left:none; border-bottom:none; }
	.stp-console-wrap .stp-corner-br{ bottom:0; right:0; border-left:none; border-top:none; }

	.stp-console{
		background:var(--bg-elevated);
		border:1px solid var(--border);
		border-radius:10px;
		overflow:hidden;
	}
	.stp-console-bar{
		display:flex;
		align-items:center;
		gap:8px;
		padding:10px 14px;
		background:var(--surface);
		border-bottom:1px dashed var(--border);
	}
	.stp-console-dot{ width:9px; height:9px; border-radius:50%; background:var(--border-soft); }
	.stp-console-dot:nth-child(1){ background:#f0665a; }
	.stp-console-dot:nth-child(2){ background:var(--amber); }
	.stp-console-dot:nth-child(3){ background:#4ade80; }
	.stp-console-label{
		margin-left:8px;
		font-family:var(--font-mono);
		font-size:.7rem;
		letter-spacing:.1em;
		text-transform:uppercase;
		color:var(--text-mute);
	}
	.stp-console-timestamp{
		margin-left:auto;
		font-family:var(--font-mono);
		font-size:.66rem;
		color:var(--text-mute);
	}
	.stp-console-body{
		padding:20px 18px 22px;
	}
	.stp-console-line{
		font-family:var(--font-mono);
		font-size:.88rem;
		line-height:1.7;
		color:var(--text);
		white-space:pre-wrap;
		word-break:break-word;
		margin:0;
	}
	.stp-console-line::before{
		content:'>';
		color:var(--cyan);
		margin-right:10px;
	}
	.stp-cursor{
		display:inline-block;
		width:7px; height:14px;
		background:var(--cyan);
		margin-left:4px;
		vertical-align:middle;
		animation:stp-blink 1s step-end infinite;
	}

	/* ---------- Profile CTA card ---------- */
	.stp-cta{
		max-width:720px;
		margin:22px auto 0;
		display:flex;
		align-items:center;
		justify-content:space-between;
		gap:14px;
		flex-wrap:wrap;
		background:linear-gradient(120deg, rgba(46,230,214,0.08), rgba(244,185,66,0.05));
		border:1px solid var(--border-soft);
		border-radius:12px;
		padding:16px 20px;
		text-decoration:none;
		color:var(--text);
		opacity:0;
		animation:stp-rise .6s ease .28s forwards;
		transition:border-color .22s ease, transform .22s ease;
	}
	.stp-cta:hover{ border-color:var(--cyan-dim); transform:translateY(-2px); }
	.stp-cta-text strong{ display:block; font-family:var(--font-display); font-size:1rem; margin-bottom:2px; }
	.stp-cta-text span{ font-family:var(--font-mono); font-size:.76rem; color:var(--text-dim); }
	.stp-cta-arrow{
		flex:0 0 auto;
		width:34px; height:34px;
		border-radius:50%;
		border:1px solid var(--cyan-dim);
		display:flex; align-items:center; justify-content:center;
		color:var(--cyan);
		transition:transform .22s ease, background .22s ease;
	}
	.stp-cta:hover .stp-cta-arrow{ transform:translateX(4px); background:rgba(46,230,214,0.1); }

	@keyframes stp-drop{ from{ opacity:0; transform:translateY(-8px);} to{ opacity:1; transform:translateY(0);} }
	@keyframes stp-rise{ from{ opacity:0; transform:translateY(12px);} to{ opacity:1; transform:translateY(0);} }
	@keyframes stp-blink{ 0%,100%{ opacity:1; } 50%{ opacity:0; } }
	@keyframes stp-pulse{
		0%{ box-shadow:0 0 0 0 rgba(74,222,128,0.55); }
		70%{ box-shadow:0 0 0 7px rgba(74,222,128,0); }
		100%{ box-shadow:0 0 0 0 rgba(74,222,128,0); }
	}
	@keyframes stp-float{
		0%, 100%{ transform:translate(0,0); }
		50%{ transform:translate(-18px, 22px); }
	}
	@keyframes stp-bob{
		0%, 100%{ transform:translateY(0); }
		50%{ transform:translateY(-10px); }
	}

	@media (prefers-reduced-motion: reduce){
		.stp-nav, .stp-hero, .stp-console-wrap, .stp-cta{ animation:none !important; opacity:1 !important; transform:none !important; }
		.stp-cursor, .stp-orb-cyan, .stp-orb-amber, .stp-glyph-1, .stp-glyph-2, .stp-nav-brand-dot{ animation:none !important; }
	}

	@media (max-width:560px){
		.stp-glyph-1, .stp-glyph-2{ display:none; }
	}
</style>

<div class="stp-root">
	<div class="stp-bg"></div>
	<div class="stp-orb stp-orb-cyan"></div>
	<div class="stp-orb stp-orb-amber"></div>
	<span class="stp-glyph stp-glyph-1">&lt;/&gt;</span>
	<span class="stp-glyph stp-glyph-2">01001101</span>

	<nav class="stp-nav">
		<span class="stp-nav-brand"><span class="stp-nav-brand-dot"></span>// student_system</span>
		<div class="stp-nav-links">
			<a href="<?=site_url('student');?>">Home</a>
			<a href="<?=site_url('student/profile');?>">Student Profile</a>
		</div>
	</nav>

	<header class="stp-hero">
		<span class="stp-hero-eyebrow">Node &middot; student/home</span>
		<h1>Student Access Terminal</h1>
		<p class="stp-hero-sub">A quick checkpoint before you reach the student profile system.</p>
	</header>

	<div class="stp-console-wrap">
		<span class="stp-corner-tr"></span>
		<span class="stp-corner-br"></span>
		<div class="stp-console">
			<div class="stp-console-bar">
				<span class="stp-console-dot"></span>
				<span class="stp-console-dot"></span>
				<span class="stp-console-dot"></span>
				<span class="stp-console-label">system message</span>
				<span class="stp-console-timestamp">student/home</span>
			</div>
			<div class="stp-console-body">
				<p class="stp-console-line"><?php echo isset($message) ? htmlspecialchars($message) : 'Welcome to the student page.'; ?><span class="stp-cursor"></span></p>
			</div>
		</div>
	</div>

	<a class="stp-cta" href="<?=site_url('student/profile');?>">
		<div class="stp-cta-text">
			<strong>Open full student profile</strong>
			<span>ID, skills, hobbies &amp; socials on record</span>
		</div>
		<span class="stp-cta-arrow">
			<svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</span>
	</a>
</div>