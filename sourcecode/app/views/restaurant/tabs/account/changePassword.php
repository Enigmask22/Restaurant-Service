<div class="p-6 mx-auto max-w-[800px] bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
    <div class="mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Đổi mật khẩu</div>
        <hr class="mt-2 border-gray-300 dark:border-gray-700">
    </div>

    <form action="<?php echo $path ?>restaurant/account/changePassword" method="POST" class="space-y-6">
        <!-- Mật khẩu cũ -->
        <div class="flex flex-col">
            <label for="password" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Mật khẩu cũ</label>
            <div class="relative">
                <input type="password" name="password" id="password"
                    class="w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                <button type="button" class="toggle-password absolute right-3 top-3 text-gray-500"
                    data-target="password">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mật khẩu mới -->
        <div class="flex flex-col">
            <label for="npassword" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Mật khẩu mới</label>
            <div class="relative">
                <input type="password" name="npassword" id="npassword"
                    class="w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                <button type="button" class="toggle-password absolute right-3 top-3 text-gray-500"
                    data-target="npassword">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mật khẩu phải có ít nhất 6 ký tự, bao gồm chữ cái
                và số.</p>
        </div>

        <!-- Nhập lại mật khẩu mới -->
        <div class="flex flex-col">
            <label for="cpassword" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Nhập lại mật khẩu
                mới</label>
            <div class="relative">
                <input type="password" name="cpassword" id="cpassword"
                    class="w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                <button type="button" class="toggle-password absolute right-3 top-3 text-gray-500"
                    data-target="cpassword">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <button type="submit"
                class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">
                <i class="bi bi-check-circle me-2"></i>Cập nhật mật khẩu
            </button>
            <button type="reset"
                class="px-6 py-3 font-semibold text-white bg-gray-500 rounded-lg border border-gray-500 shadow-md transition duration-300 ease-in-out transform hover:bg-gray-600 hover:scale-110 hover:shadow-lg focus:outline-none">
                Hủy
            </button>
        </div>
    </form>
</div>

<script>
    // Xử lý hiển thị/ẩn mật khẩu
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);

                if (input.type === 'password') {
                    input.type = 'text';
                    this.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>
                `;
                } else {
                    input.type = 'password';
                    this.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                `;
                }
            });
        });
    });
</script>