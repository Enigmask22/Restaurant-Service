<?php 
const message = array(
    0 => 'Đã có lỗi khi xóa',
    1 => 'Xóa thành công'
);
?>

<div class="flex fixed inset-0 z-50 justify-center items-center bg-gray-900 bg-opacity-50 transition-opacity duration-300">
    <div class="w-full max-w-md bg-white rounded-lg shadow-xl transition-all duration-300 transform dark:bg-gray-800">
        <div class="p-6">
            <!-- Icon thông báo -->
            <div class="flex justify-center items-center mx-auto mb-4 w-16 h-16 rounded-full">
                <?php if ($data['datar'] == 1) { ?>
                    <!-- Icon success -->
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                <?php } else { ?>
                    <!-- Icon error -->
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                <?php } ?>
            </div>

            <!-- Nội dung thông báo -->
            <div class="text-center">
                <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">
                    <?php echo $data['datar'] == 1 ? 'Thành công!' : 'Thất bại!'; ?>
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <?php echo message[$data['datar']]?>
                    </p>
                </div>
            </div>

            <!-- Nút quay lại -->
            <div class="flex justify-center mt-6">
                <a href="<?php echo $path; ?>admin/user" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-teal-500 rounded-lg transition duration-300 ease-in-out transform hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-300 hover:scale-105">
                    <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Quay lại
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Thêm animation khi hiển thị -->
<style>
    .fixed {
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .bg-white {
        animation: slideIn 0.3s ease-out;
    }
    
    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>