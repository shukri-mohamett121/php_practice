<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>

        /* ============================= */
        /* Body */
        /* ============================= */

        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }


        /* ============================= */
        /* Navbar */
        /* ============================= */

        nav {
            background-color: rgb(24 90 188);
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
            padding: 10px 15px;
        }

        .navbar-brand {
            font-size: 23px;
            letter-spacing: 0.5px;
            transition: 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.03);
        }

        .navbar-nav {
            gap: 5px;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 8px 15px !important;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.18);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.18);
        }


        /* ============================= */
        /* Sidebar */
        /* ============================= */

        .sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
            background-color: rgb(232,240,254);
            padding-top: 20px !important;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar h4 {
            color: rgb(24 90 188);
            font-weight: 700;
            margin-bottom: 20px;
        }

        .sidebar li {
            background-color: rgb(24 90 188) !important;
            padding: 10px 15px;
            margin: 7px 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar li:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 10px rgba(24, 90, 188, 0.25);
        }

        .sidebar a {
            text-decoration: none;
            color: #fff !important;
            font-weight: 500;
        }


        /* ============================= */
        /* Sections */
        /* ============================= */

        .section-bg {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .section-bg h2 {
            font-weight: 700;
            color: rgb(24 90 188);
            margin-bottom: 20px;
        }


        /* ============================= */
        /* Student Cards */
        /* ============================= */

        #students .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
        }

        #students .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 8px 25px rgba(24, 90, 188, 0.25);
        }

        #students .card-title {
            color: rgb(24 90 188);
            font-weight: 700;
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }


        /* ============================= */
        /* Courses */
        /* ============================= */

        #courses h2 {
            color: rgb(24 90 188);
            font-weight: 700;
            margin-bottom: 20px;
            border-left: 5px solid rgb(24 90 188);
            padding-left: 12px;
        }

        #courses .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(24, 90, 188, 0.15);
            transition: all 0.3s ease;
            height: 100%;
        }

        #courses .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 8px 25px rgba(24, 90, 188, 0.25);
        }

        #courses .card-body {
            padding: 22px;
            background: linear-gradient(135deg, #ffffff, #f0f6ff);
        }

        #courses .card-title {
            color: rgb(24 90 188);
            font-size: 21px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        #courses .card-text {
            color: #555;
            line-height: 1.7;
            font-size: 15px;
        }


        /* ============================= */
        /* Buttons */
        /* ============================= */

        .btn-primary {
            background-color: rgb(24 90 188);
            border-color: rgb(24 90 188);
            border-radius: 7px;
            padding: 8px 18px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            transform: scale(1.05);
        }


        /* ============================= */
        /* Grades */
        /* ============================= */

        #grades .table {
            border-radius: 8px;
            overflow: hidden;
        }

        #grades thead {
            background-color: rgb(24 90 188);
            color: white;
        }

        #grades tbody tr:hover {
            background-color: #e8f0fe;
        }


        /* ============================= */
        /* Events */
        /* ============================= */

        #events .list-group-item {
            border-radius: 7px;
            margin-bottom: 6px;
            border: 1px solid #e1e8f5;
            transition: all 0.3s ease;
        }

        #events .list-group-item:hover {
            background-color: #e8f0fe;
            transform: translateX(5px);
        }


        /* ============================= */
        /* About & Contact */
        /* ============================= */

        #about p,
        #contact p {
            color: #555;
            line-height: 1.8;
            font-size: 16px;
        }

        #contact a {
            color: rgb(24 90 188);
            font-weight: 600;
            text-decoration: none;
        }

        #contact a:hover {
            text-decoration: underline;
        }


        /* ============================= */
        /* Footer */
        /* ============================= */

        footer {
            background-color: rgb(24 90 188);
            color: white;
            box-shadow: 0 -3px 12px rgba(0, 0, 0, 0.1);
        }


        /* ============================= */
        /* Responsive */
        /* ============================= */

        @media (max-width: 991px) {

            .sidebar {
                height: auto;
                position: relative;
            }

            .navbar-nav {
                gap: 0;
            }

        }

    </style>
</head>

<body>


<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            <b>Student Management</b>
        </a>


        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a class="nav-link active"
                       aria-current="page"
                       href="#">
                        Home
                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="#about">
                        About
                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="#contact">
                        Contact
                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>