<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@500;600;700&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ===== Shared design system — "quiet ink" theme ===== */
        :root {
            --paper: #ffffff;
            --paper-dim: #f7f6f9;
            --ink: #131218;
            --ink-soft: #6f6c78;
            --ink-faint: #a8a5b0;
            --line: #e6e3ec;
            --rose: #f3d7de;
            --rose-deep: #e6b9c3;
            --rose-ink: #a85f72;
            --iris: #ded8f6;
            --iris-deep: #c6bcef;
            --iris-ink: #6f61a8;
            --mist: #dbe8f2;
            --mist-deep: #c2dbea;
            --mist-ink: #4d7793;
            --radius-lg: 22px;
            --radius-md: 15px;
            --radius-sm: 10px;
            --shadow-card: 0 24px 60px -28px rgba(19, 18, 24, 0.22);
            --shadow-tight: 0 8px 20px -12px rgba(19, 18, 24, 0.16);
            --ring: 0 0 0 4px rgba(19, 18, 24, 0.08);
        }

        * { box-sizing: border-box; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.001ms !important;
            }
        }

        html { -webkit-font-smoothing: antialiased; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Figtree', 'Segoe UI', sans-serif;
            color: var(--ink);
            background: var(--paper);
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 56px 20px;
            overflow-x: hidden;
        }

        /* soft blurred pastel fields, frosted-glass backdrop for the cards */
        body::before,
        body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            filter: blur(70px);
            z-index: 0;
            pointer-events: none;
        }

        body::before {
            width: 420px;
            height: 420px;
            top: -140px;
            right: -120px;
            background: var(--rose);
            opacity: 0.55;
        }

        body::after {
            width: 380px;
            height: 380px;
            bottom: -160px;
            left: -110px;
            background: var(--mist);
            opacity: 0.5;
        }

        .page-shell {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 640px;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: riseIn 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .page-shell.wide { max-width: 960px; }

        @keyframes riseIn {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            position: relative;
            width: 100%;
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(22px) saturate(140%);
            -webkit-backdrop-filter: blur(22px) saturate(140%);
            border: 1px solid rgba(19, 18, 24, 0.08);
            border-top: 3px solid var(--ink);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            padding: 42px 38px;
            overflow: hidden;
        }

        .card > * { position: relative; z-index: 1; }

        .moon-accent {
            display: inline-block;
            width: 0.82em;
            height: 0.82em;
            vertical-align: -0.06em;
            margin-right: 0.4em;
            flex: none;
        }

        h1 {
            font-family: 'Shippori Mincho', serif;
            font-weight: 600;
            font-size: 1.65rem;
            letter-spacing: 0.01em;
            color: var(--ink);
            margin: 0 0 8px;
            display: flex;
            align-items: center;
        }

        h2 {
            font-family: 'Shippori Mincho', serif;
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--ink);
            margin: 34px 0 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--line);
        }

        p { line-height: 1.65; color: var(--ink-soft); margin: 0 0 12px; }

        .subtle { color: var(--ink-soft); font-size: 0.93rem; }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        label {
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--ink);
            margin-bottom: -7px;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"],
        textarea,
        select {
            font-family: 'Figtree', sans-serif;
            font-size: 0.98rem;
            color: var(--ink);
            background: var(--paper);
            border: 1.5px solid var(--line);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            width: 100%;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        textarea { min-height: 96px; resize: vertical; font-family: 'Figtree', sans-serif; }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--ink);
            box-shadow: var(--ring);
            background: var(--paper-dim);
        }

        input::placeholder { color: var(--ink-faint); }

        button, .btn {
            font-family: 'Figtree', sans-serif;
            font-weight: 600;
            font-size: 0.96rem;
            color: var(--paper);
            background: var(--ink);
            border: 1.5px solid var(--ink);
            border-radius: 999px;
            padding: 12px 26px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background-color 0.18s ease, color 0.18s ease;
            box-shadow: var(--shadow-tight);
        }

        button:hover, .btn:hover {
            transform: translateY(-2px);
            background: #302e38;
            box-shadow: 0 14px 26px -12px rgba(19, 18, 24, 0.4);
        }

        button:active, .btn:active { transform: translateY(0); }

        button:focus-visible, .btn:focus-visible, a:focus-visible, input:focus-visible, select:focus-visible {
            outline: 2px solid var(--ink);
            outline-offset: 2px;
        }

        .btn-quiet {
            background: var(--paper);
            color: var(--ink);
            border: 1.5px solid var(--line);
            box-shadow: none;
        }

        .btn-quiet:hover {
            background: var(--paper-dim);
            box-shadow: var(--shadow-tight);
        }

        .btn-warn {
            background: var(--paper);
            color: var(--rose-ink);
            border: 1.5px solid var(--rose-deep);
            box-shadow: none;
        }

        .btn-warn:hover { background: var(--rose); }

        a { color: var(--ink); font-weight: 600; text-decoration: underline; text-decoration-color: var(--line); text-underline-offset: 3px; transition: text-decoration-color 0.2s ease, color 0.2s ease; }
        a:hover { text-decoration-color: var(--ink); }

        .top-link {
            align-self: flex-end;
            margin-bottom: 14px;
            font-size: 0.92rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            background: var(--iris);
            color: var(--iris-ink);
            font-weight: 600;
            font-size: 0.83rem;
            border-radius: 999px;
            padding: 5px 15px;
            margin: 4px 0 18px;
        }

        .foot-note {
            margin-top: 24px;
            font-size: 0.92rem;
            text-align: center;
        }

        .admin-panel {
            background: var(--paper-dim);
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            padding: 26px;
            margin-bottom: 32px;
        }

        .admin-panel .panel-label {
            font-family: 'Shippori Mincho', serif;
            font-weight: 600;
            font-size: 0.92rem;
            color: var(--ink);
            margin-bottom: 4px;
            display: block;
        }

        .table-wrap {
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-tight);
            border: 1px solid var(--line);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--paper);
            font-size: 0.94rem;
        }

        thead th {
            background: var(--ink);
            color: var(--paper);
            font-family: 'Shippori Mincho', serif;
            font-weight: 600;
            text-align: left;
            padding: 13px 16px;
            border: none;
        }

        thead th.actions-col { background: #302e38; }

        tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--line);
            color: var(--ink);
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr:nth-child(even) { background: var(--paper-dim); }
        tbody tr:hover { background: var(--rose); }

        td.actions-col { white-space: nowrap; }

        tbody tr {
            opacity: 0;
            animation: rowIn 0.5s ease forwards;
        }
        tbody tr:nth-child(1) { animation-delay: 0.05s; }
        tbody tr:nth-child(2) { animation-delay: 0.10s; }
        tbody tr:nth-child(3) { animation-delay: 0.15s; }
        tbody tr:nth-child(4) { animation-delay: 0.20s; }
        tbody tr:nth-child(5) { animation-delay: 0.25s; }
        tbody tr:nth-child(6) { animation-delay: 0.30s; }
        tbody tr:nth-child(7) { animation-delay: 0.35s; }
        tbody tr:nth-child(8) { animation-delay: 0.40s; }
        tbody tr:nth-child(n+9) { animation-delay: 0.45s; }

        @keyframes rowIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .action-link {
            display: inline-block;
            padding: 5px 13px;
            border-radius: 999px;
            font-size: 0.83rem;
            font-weight: 600;
            margin-right: 6px;
            text-decoration: none;
            border: 1.5px solid transparent;
            transition: background-color 0.18s ease, border-color 0.18s ease, transform 0.18s ease;
        }

        .action-edit { background: var(--iris); color: var(--iris-ink); }
        .action-edit:hover { background: var(--iris-deep); transform: translateY(-1px); }

        .action-delete { background: var(--rose); color: var(--rose-ink); }
        .action-delete:hover { background: var(--rose-deep); transform: translateY(-1px); }

        @media (max-width: 600px) {
            .card { padding: 30px 22px; }
            body { padding: 30px 12px; }
        }
    </style>
</head>
<body>
    <div class="page-shell wide">
        <a class="top-link" href="<?= site_url('auth/logout'); ?>">Logout</a>
        <div class="card">
            <h1>
                <svg class="moon-accent" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <circle cx="20" cy="20" r="16" fill="#131218"/>
                    <circle cx="27" cy="16" r="13" fill="#ffffff"/>
                </svg>
                Welcome to Product View
            </h1>
            <?php $is_edit = isset($product) && is_array($product); ?>
            <?php if ($is_admin): ?>
            <div class="admin-panel">
                <span class="panel-label">Admin tools</span>
                <form action="<?= site_url($is_edit ? 'products/edit/' . $product['id'] : 'products/create'); ?>" method="post">
                    <label for="product_name">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" value="<?= $is_edit ? $product['product_name'] : ''; ?>" required>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?= $is_edit ? $product['description'] : ''; ?></textarea>

                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?= $is_edit ? $product['price'] : ''; ?>" required>

                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="<?= $is_edit ? $product['quantity'] : ''; ?>" required>

                    <button type="submit"><?= $is_edit ? 'Update Product' : 'Add Product'; ?></button>
                </form>
            </div>
            <?php endif; ?>
            <h2>Product List</h2>
            <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <?php if ($is_admin): ?>
                        <th class="actions-col">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['id']; ?></td>
                            <td><?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= $product['price']; ?></td>
                            <td><?= $product['quantity']; ?></td>
                            <?php if ($is_admin): ?>
                            <td class="actions-col">
                                <a class="action-link action-edit" href="<?= site_url('products/edit/' . $product['id']); ?>">Edit</a>
                                <a class="action-link action-delete" href="<?= site_url('products/delete/' . $product['id']); ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</body>
</html>