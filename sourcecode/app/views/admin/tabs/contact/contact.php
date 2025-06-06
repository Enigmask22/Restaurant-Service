<form action="<?php echo $path ?>admin/general/updateContact" method="POST" class="p-6 mx-auto space-y-8 max-w-[1500px] bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
    <div class="flex justify-between items-center">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thông tin liên hệ</div>
        <hr class="mb-6 border-gray-300 dark:border-gray-700">
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Địa chỉ -->
        <div class="flex items-center">
            <label for="address" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Địa chỉ</label>
            <input type="text" name="address" id="address" class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo $data['contact']->address ?>">
        </div>

        <!-- Điện thoại -->
        <div class="flex items-center">
            <label for="phone" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Điện thoại</label>
            <input type="text" name="phone" id="phone" class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo $data['contact']->phone ?>">
        </div>

        <!-- Hotline -->
        <div class="flex items-center">
            <label for="hotline" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Hotline</label>
            <input type="text" name="hotline" id="hotline" class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo $data['contact']->hotline ?>">
        </div>

        <!-- Email -->
        <div class="flex items-center">
            <label for="email" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" name="email" id="email" class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo $data['contact']->email ?>">
        </div>
    </div>

    <div class="flex justify-between items-center mt-8">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thông tin chuyển khoản</div>
        <hr class="mb-6 border-gray-300 dark:border-gray-700">
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Chủ tài khoản -->
        <div class="flex items-center">
            <label for="fullname" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Chủ tài khoản</label>
            <input type="text" name="fullname" id="fullname" class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo $data['contact']->fullname ?>">
        </div>

        <!-- Số tài khoản -->
        <div class="flex items-center">
            <label for="bankID" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Số tài khoản</label>
            <input type="text" name="bankID" id="bankID" class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo $data['contact']->bankID ?>">
        </div>

        <!-- Ngân hàng -->
        <div class="flex items-center">
            <label for="bank_name" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Ngân hàng</label>
            <input type="text" name="bank_name" id="bank_name" class="p-3 w-3/4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo $data['contact']->bank_name ?>">
        </div>
    </div>

    <div class="flex justify-end mt-8 space-x-4">
        <button name="contactSubmit" type="submit" class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">Lưu thay đổi</button>
        <button type="reset" class="px-6 py-3 font-semibold text-white bg-rose-500 rounded-lg border border-rose-500 shadow-md transition duration-300 ease-in-out transform hover:bg-rose-600 hover:scale-110 hover:shadow-lg focus:outline-none">Bỏ thay đổi</button>
    </div>
</form>
