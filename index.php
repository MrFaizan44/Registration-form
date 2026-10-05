
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f4f6f2">
    <title>Student Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            font-family: "DM Sans", sans-serif;
            color: #1d302d;
            background: #f4f6f2;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
        }

        a {
            color: inherit;
        }

        .site-header {
            width: min(100%, 1320px);
            min-height: 82px;
            margin: 0 auto;
            padding: 1rem clamp(1.25rem, 4vw, 3.5rem);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .brand-mark {
            width: 2.65rem;
            aspect-ratio: 1;
            display: grid;
            place-items: center;
            background: #db6848;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .brand-name,
        .brand-caption {
            display: block;
        }

        .brand-name {
            font-size: 0.95rem;
            font-weight: 700;
        }

        .brand-caption {
            margin-top: 0.15rem;
            color: #6c7c76;
            font-size: 0.72rem;
        }

        .records-link {
            color: #1f624f;
            font-size: 0.875rem;
            font-weight: 700;
            text-decoration-thickness: 1px;
            text-underline-offset: 4px;
        }

        .registration-layout {
            width: min(100%, 1320px);
            min-height: min(760px, calc(100vh - 82px));
            margin: 0 auto;
            padding: 0 clamp(1.25rem, 4vw, 3.5rem) 2.5rem;
            display: grid;
            grid-template-columns: minmax(280px, 0.88fr) minmax(0, 1.12fr);
        }

        .visual-panel {
            position: relative;
            min-height: 650px;
            overflow: hidden;
            background-color: #255c4b;
            background-image:
                linear-gradient(0deg, rgb(15 39 32 / 88%) 0%, rgb(15 39 32 / 28%) 52%, rgb(15 39 32 / 8%) 100%),
                url("https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1400&q=85");
            background-position: center;
            background-size: cover;
        }

        .visual-copy {
            position: absolute;
            right: clamp(1.5rem, 4vw, 3rem);
            bottom: clamp(2rem, 5vw, 3.5rem);
            left: clamp(1.5rem, 4vw, 3rem);
            max-width: 28rem;
            color: #fff;
            animation: arrive 650ms ease-out both;
        }

        .visual-kicker,
        .form-kicker {
            margin: 0 0 0.85rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .visual-kicker {
            color: #f3bd91;
        }

        .visual-copy h2 {
            max-width: 9ch;
            margin: 0;
            font-family: "Newsreader", Georgia, serif;
            font-size: clamp(2.5rem, 4vw, 4rem);
            font-weight: 500;
            line-height: 0.98;
        }

        .visual-copy p:last-child {
            max-width: 31ch;
            margin: 1rem 0 0;
            color: rgb(255 255 255 / 84%);
            font-size: 0.95rem;
            line-height: 1.65;
        }

        .form-panel {
            display: grid;
            align-content: center;
            padding: clamp(2rem, 5vw, 4.5rem) clamp(1.5rem, 6vw, 5rem);
            background: #fff;
        }

        .form-content {
            width: min(100%, 580px);
            margin: 0 auto;
            animation: arrive 650ms 100ms ease-out both;
        }

        .form-kicker {
            margin-bottom: 0.65rem;
            color: #b95135;
        }

        h1 {
            margin: 0;
            font-family: "Newsreader", Georgia, serif;
            font-size: clamp(2.4rem, 4vw, 3.4rem);
            font-weight: 500;
            line-height: 1.05;
        }

        .intro {
            margin: 0.75rem 0 1.6rem;
            color: #667670;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .required-note {
            margin: 0 0 0.75rem;
            color: #71817b;
            font-size: 0.78rem;
        }

        .required-note span,
        label.required::after {
            color: #b95135;
        }

        form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem 1.1rem;
        }

        .field {
            min-width: 0;
            display: grid;
            align-content: start;
            gap: 0.42rem;
        }

        label {
            font-size: 0.82rem;
            font-weight: 700;
        }

        label.required::after {
            content: " *";
        }

        input,
        textarea {
            width: 100%;
            min-height: 2.9rem;
            padding: 0.72rem 0.8rem;
            border: 1px solid #d4ddd8;
            border-radius: 3px;
            background: #fbfcfb;
            color: #1d302d;
            font: inherit;
            font-size: 0.9rem;
            transition: border-color 140ms ease, background-color 140ms ease, box-shadow 140ms ease;
        }

        textarea {
            min-height: 5.25rem;
            resize: vertical;
        }

        input::placeholder,
        textarea::placeholder {
            color: #8b9993;
        }

        input:hover,
        textarea:hover {
            border-color: #aabbb2;
        }

        input:focus-visible,
        textarea:focus-visible {
            border-color: #28745e;
            outline: 0;
            background: #fff;
            box-shadow: 0 0 0 3px rgb(40 116 94 / 15%);
        }

        .wide {
            grid-column: 1 / -1;
        }

        button {
            min-height: 3.1rem;
            margin-top: 0.2rem;
            border: 0;
            border-radius: 3px;
            background: #1f624f;
            color: #fff;
            cursor: pointer;
            font: inherit;
            font-size: 0.92rem;
            font-weight: 700;
            transition: background-color 140ms ease, transform 140ms ease;
        }

        button:hover {
            background: #174c3e;
        }

        button:active {
            transform: translateY(1px);
        }

        button:focus-visible,
        a:focus-visible {
            outline: 3px solid #d08b42;
            outline-offset: 3px;
        }

        .form-footnote {
            margin: 0.85rem 0 0;
            color: #71817b;
            font-size: 0.76rem;
            line-height: 1.5;
            text-align: center;
        }

        @keyframes arrive {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 760px) {
            .site-header {
                min-height: 72px;
            }

            .registration-layout {
                min-height: 0;
                grid-template-columns: 1fr;
                padding-bottom: 1.25rem;
            }

            .visual-panel {
                min-height: 260px;
            }

            .visual-copy h2 {
                max-width: 16ch;
                font-size: 2.5rem;
            }

            .form-panel {
                padding: 2.5rem clamp(1.25rem, 6vw, 3rem);
            }
        }

        @media (max-width: 520px) {
            .site-header {
                padding-inline: 1rem;
            }

            .brand-caption {
                font-size: 0.68rem;
            }

            .records-link {
                font-size: 0.8rem;
            }

            .registration-layout {
                padding-inline: 0;
            }

            .visual-panel {
                min-height: 225px;
            }

            form {
                grid-template-columns: 1fr;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <a class="brand" href="index.php" aria-label="Student Registry home">
            <span class="brand-mark" aria-hidden="true">SR</span>
            <span>
                <span class="brand-name">Student Registry</span>
                <span class="brand-caption">Registration portal</span>
            </span>
        </a>
        <a class="records-link" href="lecweek7.php">View student records</a>
    </header>

    <main class="registration-layout">
        <section class="visual-panel" aria-label="Welcome to student registration">
            <div class="visual-copy">
                <p class="visual-kicker">A new chapter begins</p>
                <h2>Every student has a story.</h2>
                <p>Start with the details that help us welcome each student into the community.</p>
            </div>
        </section>

        <section class="form-panel" aria-labelledby="form-title">
            <div class="form-content">
                <p class="form-kicker">Student intake</p>
                <h1 id="form-title">Register a student</h1>
                <p class="intro">Add the student and family contact details to create a new record.</p>
                <p class="required-note"><span aria-hidden="true">*</span> Required fields</p>

                <form action="save.php" method="POST">
                <div class="field">
                    <label class="required" for="name">Student name</label>
                    <input id="name" name="name" type="text" autocomplete="name" minlength="2" maxlength="100" placeholder="e.g. Ahmed" required>
                </div>

                <div class="field">
                    <label class="required" for="father_name">Father's name</label>
                    <input id="father_name" name="father_name" type="text" autocomplete="off" minlength="2" maxlength="100" placeholder="e.g. Muhammad Ali" required>
                </div>

                <div class="field">
                    <label class="required" for="email">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" maxlength="254" placeholder="name@gmail.com" required>
                </div>

                <div class="field">
                    <label class="required" for="phone">Phone number</label>
                    <input id="phone" name="phone" type="tel" autocomplete="tel" maxlength="30" placeholder="e.g. +1 555 0100" required>
                </div>

                <div class="field">
                    <label class="required" for="age">Age</label>
                    <input id="age" name="age" type="number" min="1" max="120" inputmode="numeric" placeholder="e.g. 18" required>
                </div>

                <div class="field wide">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" maxlength="500" autocomplete="street-address" placeholder="Street, city, and postal code"></textarea>
                </div>

                    <button class="wide" type="submit">Create student record</button>
                </form>
                <p class="form-footnote">Your information will be added to the student records.</p>
            </div>
        </section>
    </main>
</body>
</html>