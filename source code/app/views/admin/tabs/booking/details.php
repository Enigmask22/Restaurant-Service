<?php const status = array(
    '0' => 'Chưa xác nhận',
    '1' => 'Đã xác nhận',
    '2' => 'Đã hủy',
    '3' => 'Chưa xác nhận mặc định'
); ?>

<form action="<?php echo $path; ?>admin/booking/updateStatus/<?php echo $data['booking']->bid ?>" method="post" class="max-w-[1500px] mx-auto space-y-8 p-6 bg-white shadow-md rounded-lg dark:bg-gray-800 dark:text-white">
    <div class="flex justify-between items-center">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thông tin đặt nhà hàng</div>
        <hr class="mb-6 border-gray-300 dark:border-gray-700">
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Tên nhà hàng -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Tên nhà hàng</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo $data['booking']->restaurant_name ?>
            </div>
        </div>

        <!-- Người dùng -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Người dùng</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo $data['booking']->fullname ?>
            </div>
        </div>

        <!-- Email -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Email</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo $data['booking']->email ?>
            </div>
        </div>

        <!-- SĐT -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">SĐT</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo $data['booking']->phone ?>
            </div>
        </div>

        <!-- Ngày đặt -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Ngày đặt</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo $data['booking']->createdAt ?>
            </div>
        </div>

        <!-- Trạng thái -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Trạng thái</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo status[$data['booking']->status] ?>
            </div>
        </div>

        <!-- Số người lớn -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Số người lớn</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo $data['booking']->adult_num ?>
            </div>
        </div>

        <!-- Số trẻ em -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Số trẻ em</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo $data['booking']->child_num ?>
            </div>
        </div>

        <!-- Tổng -->
        <div class="flex items-center">
            <label class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Tổng</label>
            <div class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white">
                <?php echo $data['booking']->money ?>
            </div>
        </div>

        <!-- Phản hồi trạng thái -->
        <div class="flex items-center">
            <label for="status" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Thay đổi trạng thái</label>
            <select name="status" id="status" class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="1" <?php echo $data['booking']->status == 1 ? 'selected' : ''; ?>>Đã xác nhận</option>
                <option value="2" <?php echo $data['booking']->status == 2 ? 'selected' : ''; ?>>Đã hủy</option>
                <option value="3" <?php echo $data['booking']->status == 3 ? 'selected' : ''; ?>>Chưa xác nhận</option>
            </select>
        </div>
    </div>

    <div class="flex justify-end mt-8 space-x-4">
        <button name="confirmSubmit" type="submit" class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">Lưu thay đổi</button>
        <a href="<?php echo $path; ?>admin/booking" class="px-6 py-3 font-semibold text-white bg-indigo-500 rounded-lg border border-indigo-500 shadow-md transition duration-300 ease-in-out transform hover:bg-indigo-600 hover:scale-110 hover:shadow-lg focus:outline-none">
            Quay lại
        </a>
    </div>
</form>
