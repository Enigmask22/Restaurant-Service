<div class="overflow-x-auto relative p-6 mx-auto max-w-[1500px] bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
    <div class="flex items-center justify-between mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thống kê đặt bàn theo nhà hàng</div>
        <hr class="border-gray-300 dark:border-gray-700">
    </div>

    <table class="w-full text-left text-gray-400 rtl:text-right">
        <thead class="text-lg text-gray-900 bg-gray-50 dark:text-white dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Tên nhà hàng
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Tổng số lượt đặt bàn
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Số lượt đã xác nhận
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Tỷ lệ xác nhận
                </th>
                <th scope="col" class="px-6 py-3">
                    Hành động
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['restaurants'])
                foreach ($data['restaurants'] as $restaurant) { ?>
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="text-base"><?php echo $restaurant->restaurant_name ?></div>
                        </th>
                        <td class="px-6 py-4 text-center text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php echo $restaurant->total_bookings ?>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php echo $restaurant->confirmed_bookings ?>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <?php 
                                $ratio = $restaurant->total_bookings > 0 
                                    ? round(($restaurant->confirmed_bookings / $restaurant->total_bookings) * 100, 1) 
                                    : 0;
                                echo $ratio . '%';
                            ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end">
                                <a href="<?php echo $path ?>admin/booking/restaurant_detail/<?php echo $restaurant->rid ?>"
                                    class="flex items-center justify-center px-3 py-2.5 min-w-[100px] font-medium text-teal-500 rounded-lg border border-teal-500 transition duration-300 ease-in-out transform cursor-pointer hover:text-white hover:bg-teal-500 hover:scale-110">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m3-3v6m-7 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Chi tiết
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</div>