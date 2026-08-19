<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

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
		--red:#ef4444;
		--red-dim:#991b1b;
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

	.error-root{
		position:relative;
		font-family:var(--font-body);
		background:
			radial-gradient(circle at 20% 10%, rgba(239,68,68,0.07), transparent 45%),
			var(--bg);
		color:var(--text);
		min-height:100vh;
		padding:32px 20px 70px;
		box-sizing:border-box;
		display:flex;
		align-items:center;
		justify-content:center;
		isolation:isolate;
	}

	.error-container{
		max-width:720px;
		text-align:center;
		opacity:0;
		animation:error-rise .6s ease forwards;
	}

	.error-code{
		font-family:var(--font-mono);
		font-size:3.5rem;
		font-weight:700;
		color:var(--red);
		margin:0;
		line-height:1;
		text-shadow:0 0 30px rgba(239,68,68,0.3);
	}

	.error-title{
		font-family:var(--font-display);
		font-size:1.8rem;
		font-weight:700;
		color:var(--text);
		margin:12px 0 8px;
	}

	.error-message{
		font-size:1rem;
		color:var(--text-dim);
		margin:0 0 28px;
		line-height:1.6;
	}

	.error-link{
		display:inline-flex;
		align-items:center;
		gap:10px;
		padding:12px 20px;
		background:linear-gradient(120deg, rgba(239,68,68,0.1), rgba(239,68,68,0.05));
		border:1px solid var(--red-dim);
		border-radius:8px;
		color:var(--red);
		text-decoration:none;
		font-weight:600;
		transition:all .25s ease;
	}

	.error-link:hover{
		border-color:var(--red);
		background:linear-gradient(120deg, rgba(239,68,68,0.15), rgba(239,68,68,0.08));
		transform:translateY(-2px);
	}

	.error-icon{
		width:20px;
		height:20px;
	}

	@keyframes error-rise{
		from{ opacity:0; transform:translateY(12px); }
		to{ opacity:1; transform:translateY(0); }
	}

	@media (prefers-reduced-motion: reduce){
		.error-container{ animation:none !important; opacity:1 !important; transform:none !important; }
	}
</style>

<div class="error-root">
	<div class="error-container">
		<p class="error-code">403</p>
		<h1 class="error-title">Access Forbidden</h1>
		<p class="error-message">You don't have permission to access the student profile directly.<br>Please go to the student page first to obtain access.</p>
		<a href="<?=site_url('student');?>" class="error-link">
			<svg class="error-icon" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			Back to Student Page
		</a>
	</div>
</div>
