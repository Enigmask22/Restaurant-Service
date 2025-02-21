<div class="overflow-x-auto relative p-6 mx-auto max-w-[1500px] bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
    <div class="flex justify-between items-center mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Danh sách khách hàng</div>
        <hr class="border-gray-300 dark:border-gray-700">
    </div>

    <table class="w-full text-left text-gray-400 rtl:text-right">
        <thead class="text-lg text-gray-900 bg-gray-50 dark:text-white dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">Họ và tên</th>
                <th scope="col" class="px-6 py-3">Số điện thoại</th>
                <th scope="col" class="px-6 py-3">Địa chỉ email</th>
                <th scope="col" class="px-6 py-3">Nội dung</th>
                <th scope="col" class="px-6 py-3">Địa chỉ</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['customer']) {
                foreach ($data['customer'] as $customer) { ?>
                    <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <?php echo $customer['name']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php echo $customer['phone']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php echo $customer['email']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php echo $customer['description']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php echo $customer['address']; ?>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>