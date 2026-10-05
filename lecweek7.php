<?php
$connection = mysqli_connect("localhost", "root", "", "student_db");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($connection, "SELECT id, name, father_name, email, phone, age, address FROM students ORDER BY id DESC");
if (!$result) {
    die("Unable to fetch student data: " . mysqli_error($connection));
}
$recordCount = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f4f6f2">
    <title>Student Records</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            font-family: "DM Sans", sans-serif;
            color: #1d302d;
            background: #f4f6f2;
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

        .add-link {
            min-height: 2.65rem;
            padding: 0.65rem 0.95rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #1f624f;
            border-radius: 3px;
            color: #1f624f;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
        }

        .add-link:hover {
            background: #e8f0eb;
        }

        main {
            width: min(100%, 1320px);
            margin: 0 auto;
            padding: clamp(1.5rem, 4vw, 3rem) clamp(1rem, 4vw, 3.5rem) 4rem;
        }

        .page-heading {
            margin-bottom: 1.75rem;
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1rem;
        }

        .eyebrow {
            margin: 0 0 0.45rem;
            color: #b95135;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-family: "Newsreader", Georgia, serif;
            font-size: clamp(2.3rem, 4vw, 3.3rem);
            font-weight: 500;
            line-height: 1.05;
        }

        .subtitle {
            margin: 0.65rem 0 0;
            color: #667670;
            font-size: 0.92rem;
        }

        .record-count {
            flex: 0 0 auto;
            color: #667670;
            font-size: 0.85rem;
        }

        .record-count strong {
            color: #1d302d;
            font-size: 1rem;
        }

        .table-wrap {
            overflow: auto;
            border: 1px solid #d4ddd8;
            background: #fff;
        }

        table {
            width: 100%;
            min-width: 64rem;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: #e9efeb;
        }

        th {
            padding: 0.9rem 1rem;
            color: #496059;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 0.95rem 1rem;
            border-top: 1px solid #e6ebe8;
            color: #354943;
            font-size: 0.875rem;
            vertical-align: top;
        }

        tbody tr:nth-child(even) {
            background: #fbfcfb;
        }

        tbody tr:hover {
            background: #f2f7f3;
        }

        .record-id {
            color: #71817b;
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .student-name {
            color: #1d302d;
            font-weight: 700;
        }

        .email-cell,
        .address-cell {
            overflow-wrap: anywhere;
        }

        .muted {
            color: #899790;
        }

        .empty-state {
            padding: 3rem 1rem;
            color: #667670;
            text-align: center;
        }

        .empty-state p {
            margin: 0 0 0.9rem;
        }

        .empty-state a {
            color: #1f624f;
            font-weight: 700;
            text-underline-offset: 3px;
        }

        a:focus-visible {
            outline: 3px solid #d08b42;
            outline-offset: 3px;
        }

        @media (max-width: 560px) {
            .site-header {
                min-height: 72px;
                padding-inline: 1rem;
            }

            .page-heading {
                align-items: start;
                flex-direction: column;
            }

            .record-count {
                padding-top: 0.25rem;
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
                <span class="brand-caption">Student records</span>
            </span>
        </a>
        <a class="add-link" href="index.php">Add student</a>
    </header>

    <main>
        <section class="page-heading" aria-labelledby="page-title">
            <div>
                <p class="eyebrow">Registry</p>
                <h1 id="page-title">Student records</h1>
                <p class="subtitle">Contact and enrollment details for registered students.</p>
            </div>
            <p class="record-count"><strong><?= $recordCount ?></strong> <?= $recordCount === 1 ? "student" : "students" ?></p>
        </section>

        <div class="table-wrap" role="region" aria-label="Student records table" tabindex="0">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Record</th>
                        <th scope="col">Student name</th>
                        <th scope="col">Father's name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Age</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($recordCount === 0): ?>
                        <tr>
                            <td class="empty-state" colspan="7">
                                <p>No student records yet.</p>
                                <a href="index.php">Register the first student</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php while ($student = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="record-id">#<?= (int) $student["id"] ?></td>
                                <td class="student-name"><?= htmlspecialchars($student["name"], ENT_QUOTES, "UTF-8") ?></td>
                                <td><?= $student["father_name"] ? htmlspecialchars($student["father_name"], ENT_QUOTES, "UTF-8") : '<span class="muted">Not provided</span>' ?></td>
                                <td class="email-cell"><?= htmlspecialchars($student["email"], ENT_QUOTES, "UTF-8") ?></td>
                                <td><?= $student["phone"] ? htmlspecialchars($student["phone"], ENT_QUOTES, "UTF-8") : '<span class="muted">Not provided</span>' ?></td>
                                <td><?= htmlspecialchars((string) $student["age"], ENT_QUOTES, "UTF-8") ?></td>
                                <td class="address-cell"><?= $student["address"] ? htmlspecialchars($student["address"], ENT_QUOTES, "UTF-8") : '<span class="muted">Not provided</span>' ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>

<?php mysqli_close($connection); ?>
