<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title') · {{ config('app.name') }}</title>
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --accent: #0ea5e9;
            --accent-text: #ffffff;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #0b1120;
                --card: #111827;
                --text: #e2e8f0;
                --muted: #94a3b8;
                --border: #1f2937;
                --accent: #38bdf8;
                --accent-text: #0b1120;
            }
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px 16px;
            background: var(--bg);
            color: var(--text);
            font: 16px/1.6 ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        main {
            width: 100%;
            max-width: 640px;
            padding: 40px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--card);
        }

        h1 { margin: 0 0 8px; font-size: 28px; line-height: 1.2; }
        p { margin: 0 0 24px; color: var(--muted); }
        .eyebrow { margin: 0 0 8px; color: var(--accent); font-size: 14px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; }

        .button {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            background: var(--accent);
            color: var(--accent-text);
            font-weight: 600;
            text-decoration: none;
        }

        .button:hover { opacity: .9; }

        dl { display: grid; grid-template-columns: max-content 1fr; gap: 8px 24px; margin: 0 0 24px; }
        dt { color: var(--muted); }
        dd { margin: 0; font-family: ui-monospace, SFMono-Regular, Menlo, monospace; }

        h2 { margin: 32px 0 12px; font-size: 16px; }
        ul { margin: 0; padding: 0; list-style: none; }
        li { padding: 8px 0; border-top: 1px solid var(--border); font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: 14px; overflow-wrap: anywhere; }
        .empty { color: var(--muted); font-size: 14px; }

        @media (max-width: 480px) {
            main { padding: 24px; }
        }
    </style>
</head>
<body>
<main>
    @yield('content')
</main>
</body>
</html>
