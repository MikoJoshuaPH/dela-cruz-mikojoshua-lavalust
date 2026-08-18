<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!--
	NOTE FOR INTEGRATION:
	This view is included inside your existing layout, which owns <head>/<title>.
	If your layout sets a page title variable, use this personalized one:

		Miko Joshua Dela Cruz — 3F1 Mayor & IT Student | Access Terminal

	The on-page hero below also carries the personalized identity visually,
	so the page reads correctly even if the <title> tag isn't updated.
-->
<style>
	:root{
		--bg:#0a0f1c;
		--bg-elevated:#0f1526;
		--surface:#131b2e;
		--surface-2:#161f35;
		--border:#243149;
		--border-soft:#1c2740;
		--text:#e9edf7;
		--text-dim:#96a1b8;
		--text-mute:#5c6883;
		--cyan:#2ee6d6;
		--cyan-dim:#1a9c91;
		--amber:#f4b942;
		--amber-dim:#b4862c;
		--radius-lg:18px;
		--radius-md:12px;
		--radius-sm:8px;
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

	.sp-root{
		font-family:var(--font-body);
		background:
			radial-gradient(circle at 15% 0%, rgba(46,230,214,0.08), transparent 45%),
			radial-gradient(circle at 85% 15%, rgba(244,185,66,0.06), transparent 40%),
			var(--bg);
		color:var(--text);
		padding:32px 20px 64px;
		min-height:100vh;
		box-sizing:border-box;
	}
	.sp-root *{ box-sizing:border-box; }

	/* ---------- Nav ---------- */
	.sp-nav{
		max-width:880px;
		margin:0 auto 36px;
		display:flex;
		align-items:center;
		justify-content:space-between;
		gap:12px;
		flex-wrap:wrap;
		opacity:0;
		animation:sp-drop .6s ease forwards;
	}
	.sp-nav-brand{
		font-family:var(--font-mono);
		font-size:.78rem;
		letter-spacing:.12em;
		color:var(--text-mute);
		text-transform:uppercase;
	}
	.sp-nav-links a{
		font-family:var(--font-mono);
		font-size:.82rem;
		color:var(--text-dim);
		text-decoration:none;
		margin-left:22px;
		position:relative;
		padding-bottom:4px;
		transition:color .25s ease;
	}
	.sp-nav-links a::after{
		content:'';
		position:absolute; left:0; bottom:0;
		width:0; height:1px;
		background:var(--cyan);
		transition:width .25s ease;
	}
	.sp-nav-links a:hover{ color:var(--text); }
	.sp-nav-links a:hover::after{ width:100%; }

	/* ---------- Hero / ID Badge ---------- */
	.sp-hero{
		max-width:880px;
		margin:0 auto 28px;
		position:relative;
		border-radius:var(--radius-lg);
		background:linear-gradient(155deg, var(--surface-2), var(--surface) 60%);
		border:1px solid var(--border);
		padding:34px 34px 30px;
		overflow:hidden;
		opacity:0;
		animation:sp-rise .7s ease .1s forwards;
	}
	.sp-hero::before{
		content:'';
		position:absolute; inset:0;
		background:linear-gradient(100deg, transparent 20%, rgba(46,230,214,0.07) 50%, transparent 80%);
		background-size:250% 100%;
		animation:sp-scan 7s linear infinite;
		pointer-events:none;
	}
	.sp-hero-top{
		display:flex;
		align-items:flex-start;
		justify-content:space-between;
		gap:20px;
		flex-wrap:wrap;
		position:relative;
	}
	.sp-id-tag{
		font-family:var(--font-mono);
		font-size:.72rem;
		letter-spacing:.14em;
		color:var(--cyan);
		text-transform:uppercase;
		border:1px solid var(--cyan-dim);
		background:rgba(46,230,214,0.07);
		padding:5px 10px;
		border-radius:999px;
		display:inline-block;
		margin-bottom:16px;
	}
	.sp-status{
		display:flex;
		align-items:center;
		gap:8px;
		font-family:var(--font-mono);
		font-size:.72rem;
		letter-spacing:.1em;
		text-transform:uppercase;
		color:#8fe9c0;
		background:rgba(74,222,128,0.08);
		border:1px solid rgba(74,222,128,0.35);
		padding:6px 12px;
		border-radius:999px;
	}
	.sp-status-dot{
		width:7px; height:7px; border-radius:50%;
		background:#4ade80;
		box-shadow:0 0 0 0 rgba(74,222,128,0.6);
		animation:sp-pulse 1.8s ease-out infinite;
	}

	.sp-hero-main{
		display:flex;
		align-items:center;
		gap:22px;
		margin-top:6px;
		position:relative;
		flex-wrap:wrap;
	}
	.sp-avatar{
		flex:0 0 auto;
		width:82px; height:82px;
		border-radius:20px;
		background:linear-gradient(145deg, var(--cyan), #1b7f76);
		display:flex; align-items:center; justify-content:center;
		font-family:var(--font-display);
		font-weight:700;
		font-size:1.7rem;
		color:#06120f;
		box-shadow:0 8px 26px -8px rgba(46,230,214,0.55);
	}
	.sp-hero-name h1{
		margin:0 0 6px;
		font-family:var(--font-display);
		font-size:clamp(1.5rem, 3.4vw, 2.15rem);
		font-weight:700;
		letter-spacing:.01em;
		color:var(--text);
	}
	.sp-hero-role{
		font-family:var(--font-mono);
		font-size:.86rem;
		color:var(--amber);
		letter-spacing:.02em;
	}
	.sp-hero-role span{ color:var(--text-mute); margin:0 6px; }

	/* ---------- Section shell ---------- */
	.sp-section{
		max-width:880px;
		margin:0 auto 22px;
		background:var(--surface);
		border:1px solid var(--border-soft);
		border-radius:var(--radius-md);
		padding:26px 28px;
		opacity:0;
		transform:translateY(16px);
		transition:opacity .6s ease, transform .6s ease;
	}
	.sp-section.sp-in-view{ opacity:1; transform:translateY(0); }

	.sp-section-head{
		display:flex;
		align-items:center;
		gap:10px;
		margin-bottom:18px;
	}
	.sp-section-head .sp-dot{
		width:6px; height:6px; border-radius:50%;
		background:var(--cyan);
	}
	.sp-section-head h2{
		font-family:var(--font-display);
		font-size:1rem;
		letter-spacing:.03em;
		text-transform:uppercase;
		color:var(--text-dim);
		margin:0;
		font-weight:600;
	}

	/* ---------- Bio ---------- */
	.sp-bio{
		font-size:.98rem;
		line-height:1.7;
		color:var(--text);
		border-left:2px solid var(--cyan-dim);
		padding-left:16px;
		font-style:normal;
	}

	/* ---------- Info readout ---------- */
	.sp-info-grid{
		display:grid;
		grid-template-columns:repeat(2, 1fr);
		gap:14px 18px;
	}
	.sp-info-item{
		background:var(--bg-elevated);
		border:1px solid var(--border-soft);
		border-radius:var(--radius-sm);
		padding:12px 14px;
		transition:border-color .25s ease, transform .25s ease;
	}
	.sp-info-item:hover{
		border-color:var(--cyan-dim);
		transform:translateY(-2px);
	}
	.sp-info-item.sp-span-2{ grid-column:1 / -1; }
	.sp-info-label{
		font-family:var(--font-mono);
		font-size:.68rem;
		letter-spacing:.1em;
		text-transform:uppercase;
		color:var(--text-mute);
		margin-bottom:5px;
	}
	.sp-info-value{
		font-size:.94rem;
		color:var(--text);
		font-weight:500;
		word-break:break-word;
	}

	/* ---------- Chips (skills / hobbies) ---------- */
	.sp-chip-row{
		display:flex;
		flex-wrap:wrap;
		gap:10px;
	}
	.sp-chip{
		font-family:var(--font-mono);
		font-size:.78rem;
		letter-spacing:.03em;
		padding:8px 14px;
		border-radius:999px;
		border:1px solid var(--border-soft);
		background:var(--bg-elevated);
		color:var(--text-dim);
		transition:all .25s ease;
		cursor:default;
	}
	.sp-chip.sp-skill:hover{
		color:#04231f;
		background:var(--cyan);
		border-color:var(--cyan);
		box-shadow:0 6px 18px -6px rgba(46,230,214,0.6);
		transform:translateY(-2px);
	}
	.sp-chip.sp-hobby:hover{
		color:#2b1c04;
		background:var(--amber);
		border-color:var(--amber);
		box-shadow:0 6px 18px -6px rgba(244,185,66,0.55);
		transform:translateY(-2px);
	}

	/* ---------- Social / links ---------- */
	.sp-link-grid{
		display:grid;
		grid-template-columns:repeat(auto-fit, minmax(190px, 1fr));
		gap:12px;
	}
	.sp-link-card{
		display:flex;
		align-items:center;
		gap:12px;
		padding:13px 14px;
		background:var(--bg-elevated);
		border:1px solid var(--border-soft);
		border-radius:var(--radius-sm);
		text-decoration:none;
		color:var(--text);
		transition:transform .22s ease, border-color .22s ease, background .22s ease;
	}
	.sp-link-card:hover{
		transform:translateY(-3px);
		border-color:var(--cyan-dim);
		background:var(--surface-2);
	}
	.sp-link-icon{
		flex:0 0 auto;
		width:36px; height:36px;
		border-radius:9px;
		display:flex; align-items:center; justify-content:center;
		background:var(--surface-2);
		color:var(--cyan);
	}
	.sp-link-card.sp-live .sp-link-icon{ color:var(--amber); }
	.sp-link-text{ display:flex; flex-direction:column; line-height:1.3; }
	.sp-link-text strong{ font-size:.88rem; font-weight:600; }
	.sp-link-text span{ font-family:var(--font-mono); font-size:.7rem; color:var(--text-mute); }

	/* ---------- Footer ---------- */
	.sp-foot{
		max-width:880px;
		margin:26px auto 0;
		text-align:center;
		font-family:var(--font-mono);
		font-size:.72rem;
		color:var(--text-mute);
		letter-spacing:.06em;
	}

	/* ---------- Animations ---------- */
	@keyframes sp-drop{ from{ opacity:0; transform:translateY(-8px);} to{ opacity:1; transform:translateY(0);} }
	@keyframes sp-rise{ from{ opacity:0; transform:translateY(14px);} to{ opacity:1; transform:translateY(0);} }
	@keyframes sp-scan{ 0%{ background-position:0% 0;} 100%{ background-position:-250% 0;} }
	@keyframes sp-pulse{
		0%{ box-shadow:0 0 0 0 rgba(74,222,128,0.55); }
		70%{ box-shadow:0 0 0 8px rgba(74,222,128,0); }
		100%{ box-shadow:0 0 0 0 rgba(74,222,128,0); }
	}

	@media (prefers-reduced-motion: reduce){
		.sp-nav, .sp-hero, .sp-section{ animation:none !important; opacity:1 !important; transform:none !important; }
		.sp-hero::before{ animation:none !important; }
		.sp-status-dot{ animation:none !important; }
	}

	@media (max-width:560px){
		.sp-info-grid{ grid-template-columns:1fr; }
		.sp-hero{ padding:26px 20px; }
		.sp-section{ padding:20px; }
	}
</style>

<div class="sp-root">

	<nav class="sp-nav">
		<span class="sp-nav-brand">// student_system</span>
		<div class="sp-nav-links">
			<a href="<?=site_url('student');?>">Home</a>
			<a href="<?=site_url('student/profile');?>">Student Profile</a>
		</div>
	</nav>

	<header class="sp-hero">
		<div class="sp-hero-top">
			<span class="sp-id-tag">ID · MCC2024-00043</span>
			<span class="sp-status"><span class="sp-status-dot"></span>Access Granted</span>
		</div>
		<div class="sp-hero-main">
			<div class="sp-avatar">MJ</div>
			<div class="sp-hero-name">
				<h1>Dela Cruz, Miko Joshua Austria</h1>
				<div class="sp-hero-role">3F1 Mayor <span>·</span> IT Student <span>·</span> SY 2026&ndash;2027</div>
			</div>
		</div>
	</header>

	<section class="sp-section">
		<div class="sp-section-head"><span class="sp-dot"></span><h2>About</h2></div>
		<p class="sp-bio">Ako nga pala si Miko Joshua A. Dela Cruz, Mayor ng 3F1 (SY. 2026&ndash;2027). Single po ako ngayon and pursuing my dreams and you.</p>
		<p class="sp-bio"><p>Quote: Hindi masamang gumamit ng ai, wag lang natin aabusuhin</p>
		<p>-Miko Joshua A. Dela Cruz</p>
		</p>

	</section>

	<section class="sp-section">
		<div class="sp-section-head"><span class="sp-dot"></span><h2>Student Information</h2></div>
		<div class="sp-info-grid">
			<div class="sp-info-item">
				<div class="sp-info-label">Student ID</div>
				<div class="sp-info-value">MCC2024-00043</div>
			</div>
			<div class="sp-info-item">
				<div class="sp-info-label">Course &amp; Section</div>
				<div class="sp-info-value">3F1</div>
			</div>
			<div class="sp-info-item sp-span-2">
				<div class="sp-info-label">Full Name</div>
				<div class="sp-info-value">Dela Cruz, Miko Joshua Austria</div>
			</div>
			<div class="sp-info-item sp-span-2">
				<div class="sp-info-label">Address</div>
				<div class="sp-info-value">Brgy. Tawagan, Calapan City, Oriental Mindoro</div>
			</div>
			<div class="sp-info-item sp-span-2">
				<div class="sp-info-label">Contact Number</div>
				<div class="sp-info-value">0981 222 7628</div>
			</div>
		</div>
	</section>

	<section class="sp-section">
		<div class="sp-section-head"><span class="sp-dot"></span><h2>Skills</h2></div>
		<div class="sp-chip-row">
			<span class="sp-chip sp-skill">Dancer</span>
			<span class="sp-chip sp-skill">Coding</span>
			<span class="sp-chip sp-skill">Problem-Solving</span>
			<span class="sp-chip sp-skill">Communication</span>
			<span class="sp-chip sp-skill">Leadership</span>
		</div>
	</section>

	<section class="sp-section">
		<div class="sp-section-head"><span class="sp-dot"></span><h2>Hobbies</h2></div>
		<div class="sp-chip-row">
			<span class="sp-chip sp-hobby">Online Gaming</span>
			<span class="sp-chip sp-hobby">Watching Movies</span>
			<span class="sp-chip sp-hobby">Eating</span>
			<span class="sp-chip sp-hobby">Sleeping</span>
		</div>
	</section>

	<section class="sp-section">
		<div class="sp-section-head"><span class="sp-dot"></span><h2>Connect</h2></div>
		<div class="sp-link-grid">
			<a class="sp-link-card" href="https://www.facebook.com/mikojoshuaph" target="_blank" rel="noopener noreferrer">
				<span class="sp-link-icon">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M13.5 21v-8h2.7l.4-3.2h-3.1V7.7c0-.9.3-1.6 1.7-1.6h1.6V3.2C16.5 3.1 15.4 3 14.2 3c-2.7 0-4.5 1.6-4.5 4.6v2.2H7v3.2h2.7v8h3.8Z" fill="currentColor"/></svg>
				</span>
				<span class="sp-link-text"><strong>Facebook</strong><span>mikojoshuaph</span></span>
			</a>
			<a class="sp-link-card" href="https://www.tiktok.com/@mikoshuaofficial?is_from_webapp=1&amp;sender_device=pc" target="_blank" rel="noopener noreferrer">
				<span class="sp-link-icon">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M16.6 5.1c-.9-.6-1.5-1.6-1.6-2.7h-3v13.1a2.6 2.6 0 1 1-1.9-2.5v-3.1a5.6 5.6 0 1 0 4.9 5.6V9.4a6.9 6.9 0 0 0 4 1.3V7.6c-.9 0-1.7-.3-2.4-.8Z" fill="currentColor"/></svg>
				</span>
				<span class="sp-link-text"><strong>TikTok</strong><span>@mikoshuaofficial</span></span>
			</a>
			<a class="sp-link-card" href="https://www.instagram.com/mikojoshuaph?igsh=MWppYzZ6eTRremx3Zg%3D%3D" target="_blank" rel="noopener noreferrer">
				<span class="sp-link-icon">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="3.5" y="3.5" width="17" height="17" rx="5" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3.6" stroke="currentColor" stroke-width="1.6"/><circle cx="16.9" cy="7.1" r="1" fill="currentColor"/></svg>
				</span>
				<span class="sp-link-text"><strong>Instagram</strong><span>mikojoshuaph</span></span>
			</a>
			<a class="sp-link-card sp-live" href="https://dela-cruz-mikojoshua.onrender.com/" target="_blank" rel="noopener noreferrer">
				<span class="sp-link-icon">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 12h17M12 3.5c2.2 2.3 3.4 5.2 3.4 8.5s-1.2 6.2-3.4 8.5c-2.2-2.3-3.4-5.2-3.4-8.5S9.8 5.8 12 3.5Z" stroke="currentColor" stroke-width="1.6"/></svg>
				</span>
				<span class="sp-link-text"><strong>Live Deployment</strong><span>view site</span></span>
			</a>
		</div>
	</section>

	<div class="sp-foot">MCC2024-00043 &middot; SESSION AUTHENTICATED &middot; 3F1</div>
</div>

<script>
	(function(){
		var sections = document.querySelectorAll('.sp-section');
		if(!('IntersectionObserver' in window)){
			sections.forEach(function(s){ s.classList.add('sp-in-view'); });
			return;
		}
		var observer = new IntersectionObserver(function(entries){
			entries.forEach(function(entry){
				if(entry.isIntersecting){
					entry.target.classList.add('sp-in-view');
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.15 });
		sections.forEach(function(s){ observer.observe(s); });
	})();
</script>