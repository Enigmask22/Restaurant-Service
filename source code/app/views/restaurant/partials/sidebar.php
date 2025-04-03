<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5SR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo $path ?>css/user.css">
    <style>
        /* CSS to hide the sidebar when the class 'hidden' is added */
        .hidden {
            transform: translateX(-100%);
        }

        body {
            background-color: #0a191c;
            /* Thay mã màu theo ý muốn (ví dụ: #f0f0f0 cho màu xám sáng) */
        }
    </style>
</head>

<body>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('default-sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 text-sm text-gray-500 rounded-lg ms-3 sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="overflow-y-auto px-3 py-4 h-full bg-gray-800">
            <ul class="space-y-2 font-medium">

                <li>
                    <a href="<?php echo $path ?>restaurant/home/restaurant_detail"
                        class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M3 22V2h18v20H3zm2-2h14V4H5v16zm4-10h2v2H9v-2zm0 4h2v2H9v-2zm4-4h2v2h-2v-2zm0 4h2v2h-2v-2z" />
                        </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Quản lý nhà hàng</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $path ?>restaurant/booking"
                        class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z" />
                        </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Quản lý đặt nhà hàng</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $path ?>restaurant/resimg"
                        class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5z" />
                        </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Quản lý hình ảnh nhà hàng</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $path ?>restaurant/account/changePassword"
                        class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M19 11h-3V8c0-2.21-1.79-4-4-4S8 5.79 8 8v3H5c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7c0-1.1-.9-2-2-2zm-7 8.5c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zM10 8c0-1.1.9-2 2-2s2 .9 2 2v3h-4V8z" />
                        </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Đổi mật khẩu</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $path ?>user/account/logout"
                        class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M9 3v2h6v14H9v2h8V3H9zm-1 7H3v4h5v3l5-5-5-5v3z" />
                        </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <div class="p-4 sm:ml-64">