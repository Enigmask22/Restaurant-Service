<div class="p-6 mx-auto max-w-[800px] bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
    <div class="mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thông tin tài khoản</div>
        <hr class="mt-2 border-gray-300 dark:border-gray-700">
    </div>

    <div class="space-y-6">
        <!-- Tên nhà hàng -->
        <div class="flex items-center">
            <span class="w-1/3 text-lg font-medium text-gray-900 dark:text-white">Tên nhà hàng:</span>
            <span class="w-2/3 p-3 text-gray-700 dark:text-gray-300">
                <?php echo $data['restaurant']['restaurant'][0]['restaurant_name'] ?>
            </span>
        </div>

        <!-- Email -->
        <div class="flex items-center">
            <span class="w-1/3 text-lg font-medium text-gray-900 dark:text-white">Email:</span>
            <span class="w-2/3 p-3 text-gray-700 dark:text-gray-300">
                <?php echo $data['restaurant']['restaurant'][0]['res_mail'] ?? 'Chưa cập nhật' ?>
            </span>
        </div>

        <!-- Giờ mở cửa -->
        <div class="flex items-center">
            <span class="w-1/3 text-lg font-medium text-gray-900 dark:text-white">Giờ mở cửa:</span>
            <span class="w-2/3 p-3 text-gray-700 dark:text-gray-300">
                <?php echo $data['restaurant']['restaurant'][0]['open_time'] ?>
            </span>
        </div>

        <!-- Địa chỉ -->
        <div class="flex items-center">
            <span class="w-1/3 text-lg font-medium text-gray-900 dark:text-white">Địa chỉ:</span>
            <span class="w-2/3 p-3 text-gray-700 dark:text-gray-300">
                <?php echo $data['restaurant']['restaurant'][0]['address'] ?>
            </span>
        </div>

        <div class="flex justify-end mt-6">
            <a href="<?php echo $path ?>restaurant/home/restaurant_detail"
                class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">
                Cập nhật thông tin
            </a>
        </div>
    </div>
</div>