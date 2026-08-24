@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <!-- Card -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <!-- Card Header -->
        <div class="px-5 py-4 sm:px-6 sm:py-5 border-b border-gray-100 dark:border-gray-800">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Daftar Pengguna
                    </h3>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-800 sm:p-6">
            <div class="space-y-6">
                <div class="overflow-hidden" x-data="userTable()">
                    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-start">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input x-model="search" type="text" placeholder="Search..." 
                                class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-blue-800 xl:w-[300px]">
                        </div>
                        <div class="flex items-center gap-3">
                            <select x-model="statusFilter" id="status-filter" 
                                    class="h-[42px] rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Semua Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <button id="refresh-btn" @click="loadData()" :disabled="isLoading"
                                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 h-[42px]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Refresh
                            </button>
                        </div>
                    </div>    

                    <!-- Loading Indicator -->
                    <div x-show="isLoading" class="flex justify-center items-center py-8">
                        <div class="w-8 h-8 border-4 border-brand-500 border-t-transparent rounded-full animate-spin"></div>
                    </div>

                    <!-- Table -->
                    <div x-show="!isLoading" class="max-w-full overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05] w-16">
                                        <div class="flex items-center justify-between w-full cursor-pointer" @click="sortBy('id')">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">No</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05] w-20">
                                        <div class="flex items-center justify-between w-full cursor-pointer">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Foto</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full cursor-pointer" @click="sortBy('name')">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Nama Pengguna</p>
                                            <span class="flex flex-col gap-0.5">
                                                <svg class="fill-gray-300 dark:fill-gray-700" width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z" fill="" />
                                                </svg>
                                                <svg class="fill-gray-300 dark:fill-gray-700" width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z" fill="" />
                                                </svg>
                                            </span>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-right border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-end w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Saldo</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-right border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Email</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-right border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">No. Whatsapp</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-right border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Dibuat</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-center border border-gray-100 dark:border-white/[0.05] w-24">
                                        <div class="flex items-center justify-center w-full cursor-pointer">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Status</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-center border border-gray-100 dark:border-white/[0.05] w-24">
                                        <div class="flex items-center justify-between w-full cursor-pointer">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Role</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-center border border-gray-100 dark:border-white/[0.05] w-24">
                                        <div class="flex items-center justify-center w-full cursor-pointer">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Aksi</p>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(user, index) in paginatedData" :key="user.id">
                                    <tr class="border-t border-gray-100 dark:border-white/[0.5]">
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="startEntry + index"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <template x-if="user.image">
                                                <img :src="'/' + user.image" class="w-10 h-10 object-cover rounded-lg mx-auto">
                                            </template>
                                            <template x-if="!user.image">
                                                <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            </template>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90" x-text="user.name"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-right">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="user.balance"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="user.email"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="user.wa_number"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="user.created_at"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <span x-html="getStatusBadge(user.is_active)"></span>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="user.role_name"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button @click="viewDetail(user.id)" class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500" title="Edit">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0911 3.53206C16.2124 2.65338 14.7878 2.65338 13.9091 3.53206L5.6074 11.8337C5.29899 12.1421 5.08687 12.5335 4.99684 12.9603L4.26177 16.445C4.20943 16.6931 4.286 16.9508 4.46529 17.1301C4.64458 17.3094 4.90232 17.3859 5.15042 17.3336L8.63507 16.5985C9.06184 16.5085 9.45324 16.2964 9.76165 15.988L18.0633 7.68631C18.942 6.80763 18.942 5.38301 18.0633 4.50433L17.0911 3.53206ZM14.9697 4.59272C15.2626 4.29982 15.7375 4.29982 16.0304 4.59272L17.0027 5.56499C17.2956 5.85788 17.2956 6.33276 17.0027 6.62565L16.1043 7.52402L14.0714 5.49109L14.9697 4.59272ZM13.0107 6.55175L6.66806 12.8944C6.56526 12.9972 6.49455 13.1277 6.46454 13.2699L5.96704 15.6283L8.32547 15.1308C8.46772 15.1008 8.59819 15.0301 8.70099 14.9273L15.0436 8.58468L13.0107 6.55175Z" fill="currentColor" />
                                                    </svg>
                                                </button>
                                                <button @click="deleteRow(user.id,user.name)" class="text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500" title="Hapus">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.04142 4.29199C7.04142 3.04935 8.04878 2.04199 9.29142 2.04199H11.7081C12.9507 2.04199 13.9581 3.04935 13.9581 4.29199V4.54199H16.1252H17.166C17.5802 4.54199 17.916 4.87778 17.916 5.29199C17.916 5.70621 17.5802 6.04199 17.166 6.04199H16.8752V8.74687V13.7469V16.7087C16.8752 17.9513 15.8678 18.9587 14.6252 18.9587H6.37516C5.13252 18.9587 4.12516 17.9513 4.12516 16.7087V13.7469V8.74687V6.04199H3.8335C3.41928 6.04199 3.0835 5.70621 3.0835 5.29199C3.0835 4.87778 3.41928 4.54199 3.8335 4.54199H4.87516H7.04142V4.29199ZM15.3752 13.7469V8.74687V6.04199H13.9581H13.2081H7.79142H7.04142H5.62516V8.74687V13.7469V16.7087C5.62516 17.1229 5.96095 17.4587 6.37516 17.4587H14.6252C15.0394 17.4587 15.3752 17.1229 15.3752 16.7087V13.7469ZM8.54142 4.54199H12.4581V4.29199C12.4581 3.87778 12.1223 3.54199 11.7081 3.54199H9.29142C8.87721 3.54199 8.54142 3.87778 8.54142 4.29199V4.54199ZM8.8335 8.50033C9.24771 8.50033 9.5835 8.83611 9.5835 9.25033V14.2503C9.5835 14.6645 9.24771 15.0003 8.8335 15.0003C8.41928 15.0003 8.0835 14.6645 8.0835 14.2503V9.25033C8.0835 8.83611 8.41928 8.50033 8.8335 8.50033ZM12.9168 9.25033C12.9168 8.83611 12.581 8.50033 12.1668 8.50033C11.7526 8.50033 11.4168 8.83611 11.4168 9.25033V14.2503C11.4168 14.6645 11.7526 15.0003 12.1668 15.0003C12.581 15.0003 12.9168 14.6645 12.9168 14.2503V9.25033Z" fill="currentColor" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="paginatedData.length === 0">
                                    <td colspan="9" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data yang ditemukan
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="border-t-0 border rounded-b-xl border-gray-100 py-4 pl-[18px] pr-4 dark:border-white/[0.05]">
                        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between">
                            <p class="pt-3 text-sm font-medium text-center text-gray-500 border-t border-gray-100 dark:border-gray-800 dark:text-gray-400 xl:border-t-0 xl:pt-0 xl:text-left">
                                Showing <span x-text="startEntry"></span> to <span x-text="endEntry"></span> of <span x-text="totalFiltered"></span> entries
                            </p>
                            <div class="flex items-center justify-center gap-0.5 xl:justify-normal xl:pt-0">
                                <button @click="prevPage" :disabled="currentPage === 1" class="mr-2.5 flex items-center h-10 justify-center rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-gray-700 shadow-theme-xs hover:bg-gray-50 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                    Previous
                                </button>

                                <button @click="goToPage(1)" :class="currentPage === 1 ? 'bg-blue-500/[0.08] text-brand-500' : 'text-gray-700 dark:text-gray-400'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium hover:bg-blue-500/[0.08] hover:text-brand-500 dark:hover:text-brand-500">
                                    1
                                </button>

                                <span x-show="currentPage > 3" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-500/[0.08] hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">...</span>

                                <template x-for="page in pagesAroundCurrent" :key="page">
                                    <button @click="goToPage(page)" :class="currentPage === page ? 'bg-blue-500/[0.08] text-brand-500' : 'text-gray-700 dark:text-gray-400'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium hover:bg-blue-500/[0.08] hover:text-brand-500 dark:hover:text-brand-500" x-text="page"></button>
                                </template>

                                <span x-show="currentPage < totalPages - 2" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-500/[0.08] hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">...</span>

                                <button x-show="totalPages > 1" @click="goToPage(totalPages)" :class="currentPage === totalPages ? 'bg-blue-500/[0.08] text-brand-500' : 'text-gray-700 dark:text-gray-400'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium hover:bg-blue-500/[0.08] hover:text-brand-500 dark:hover:text-brand-500" x-text="totalPages"></button>

                                <button @click="nextPage" :disabled="currentPage === totalPages" class="ml-2.5 flex items-center h-10 justify-center rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-gray-700 shadow-theme-xs hover:bg-gray-50 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail & Edit User -->
                    <div
                        x-show="detailModal.open"
                        @keydown.escape.window="detailModal.open = false"
                        class="fixed inset-0 z-99999 flex items-center justify-center p-4"
                        style="display: none;">
                        <!-- Backdrop -->
                        <div
                            @click="detailModal.open = false"
                            class="fixed inset-0 h-full w-full bg-gray-900/40 backdrop-blur-sm"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                        ></div>

                        <!-- Modal Content -->
                        <div
                            @click.stop=""
                            class="relative w-full max-w-4xl rounded-2xl bg-white dark:bg-gray-900 shadow-2xl max-h-[90vh] flex flex-col"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                        >
                            <!-- Header -->
                            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex-shrink-0">
                                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Info Pengguna</h3>
                                <button
                                    @click="detailModal.open = false"
                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 transition-colors"
                                >
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z" fill="currentColor"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Body -->
                            <div class="flex flex-col sm:flex-row overflow-y-auto flex-1">

                                <!-- Panel Kiri: Info Ringkas -->
                                <div class="sm:w-60 flex-shrink-0 bg-gray-50 dark:bg-gray-800/50 flex flex-col items-center px-6 py-8 border-b sm:border-b-0 sm:border-r border-gray-100 dark:border-gray-800">

                                    <!-- Foto -->
                                    <div class="mb-4 cursor-pointer" onclick="document.getElementById('edit_image').click()">
                                        <template x-if="detailModal.user.image">
                                            <div class="relative group">
                                                <img
                                                    :src="'/' + detailModal.user.image"
                                                    id="edit-preview-img"
                                                    class="w-24 h-24 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-md group-hover:opacity-75 transition-opacity"
                                                >
                                                <div class="absolute inset-0 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg class="w-8 h-8 text-white drop-shadow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </template>
                                        <template x-if="!detailModal.user.image">
                                            <div class="relative group w-24 h-24 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center border-4 border-white dark:border-gray-600 shadow-md">
                                                <svg class="w-12 h-12 text-gray-400 group-hover:opacity-50 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <div class="absolute inset-0 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <!-- <p class="text-xs text-gray-400 mb-4">Klik foto untuk mengubah</p> -->

                                    <!-- Nama & Email -->
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white/90 text-center" x-text="detailModal.user.full_name || detailModal.user.name"></p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 text-center mb-3" x-text="detailModal.user.email"></p>

                                    <!-- Badge Status -->
                                    <span x-html="getStatusBadge(detailModal.user.is_active)" class="mb-5"></span>

                                    <!-- Saldo -->
                                    <div class="w-full rounded-xl bg-blue-50 dark:bg-blue-500/10 px-4 py-3 text-center mb-5">
                                        <p class="text-xs text-blue-500 dark:text-blue-400 font-medium mb-1">💳 Saldo</p>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white/90"
                                        x-text="'Rp ' + formatRupiah(detailModal.user.balance || 0)"></p>
                                    </div>

                                    <!-- Info Ringkas -->
                                    <div class="w-full space-y-2.5 text-xs text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            <span x-text="getRoleName(detailModal.user.role_id)"></span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span x-text="detailModal.user.wa_number || '-'"></span>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span x-text="detailModal.user.full_address || '-'"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Panel Kanan: Form Edit -->
                                <div class="flex-1 overflow-y-auto">
                                    <form id="editUserForm" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="edit_user_id" name="user_id">
                                        <input type="file" id="edit_image" name="image" accept="image/*" class="hidden">

                                        <div class="px-6 py-6">
                                            <h4 class="text-sm font-semibold text-gray-800 dark:text-white/90 mb-5">Detail Pengguna</h4>

                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                <!-- Nama Akun -->
                                                <!-- <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Nama Akun</label>
                                                    <input type="text" id="edit_name" name="name"
                                                        class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                                                </div> -->

                                                <!-- Nama Lengkap -->
                                                <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</label>
                                                    <input type="text" id="edit_full_name" name="full_name"
                                                        class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                                                </div>

                                                <!-- Email -->
                                                <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Email</label>
                                                    <input type="email" id="edit_email" name="email"
                                                        class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                                                </div>

                                                <!-- No HP -->
                                                <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">No. HP / WhatsApp</label>
                                                    <input type="text" id="edit_wa_number" name="wa_number"
                                                        class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                                                </div>

                                                <!-- Status -->
                                                <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Status</label>
                                                    <select id="edit_is_active" name="is_active"
                                                        class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>

                                                <!-- Tempat Lahir -->
                                                <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Tempat Lahir</label>
                                                    <input type="text" id="edit_place_of_birth" name="place_of_birth"
                                                        class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                                                </div>

                                                <!-- Tanggal Lahir -->
                                                <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Tanggal Lahir</label>
                                                    <input type="date" id="edit_date_of_birth" name="date_of_birth"
                                                        class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                                                </div>

                                                <!-- Hak Akses -->
                                                <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Hak Akses</label>

                                                    <div
                                                        class="relative"
                                                        x-data="{
                                                            open        : false,
                                                            search      : '',
                                                            roles       : [],   
                                                            selectedId  : null,
                                                            selectedName: 'Pilih Hak Akses',

                                                            get filteredRoles() {
                                                                if (!this.search) return this.roles;
                                                                return this.roles.filter(r =>
                                                                    r.name.toLowerCase().includes(this.search.toLowerCase())
                                                                );
                                                            },

                                                            select(role) {
                                                                this.selectedId   = role.id;
                                                                this.selectedName = role.name;
                                                                this.search       = '';
                                                                this.open         = false;
                                                                document.getElementById('edit_role_id').value = role.id;
                                                            },

                                                            openDropdown() {
                                                                this.open   = true;
                                                                this.search = '';
                                                                this.$nextTick(() => this.$refs.searchInput.focus());
                                                            },

                                                            init() {
                                                                // Saat roles di parent berubah, sync ke sini
                                                                this.$watch('$root.__x_interop', () => {});

                                                                document.getElementById('edit_role_id').addEventListener('change', (e) => {
                                                                    const roleId = e.target.value;
                                                                    const role   = this.roles.find(r => r.id == roleId);
                                                                    if (role) {
                                                                        this.selectedId   = role.id;
                                                                        this.selectedName = role.name;
                                                                    }
                                                                });

                                                                // Listener saat roles di-load dari parent (viewDetail)
                                                                window.addEventListener('roles-loaded', (e) => {
                                                                    this.roles = e.detail.roles;
                                                                });

                                                                window.addEventListener('set-role', (e) => {
                                                                    this.selectedId   = e.detail.id;
                                                                    this.selectedName = e.detail.name;
                                                                    document.getElementById('edit_role_id').value = e.detail.id;
                                                                });

                                                                // ← Tutup dropdown saat modal ditutup
                                                                window.addEventListener('close-detail-modal', () => {
                                                                    this.open   = false;
                                                                    this.search = '';
                                                                });
                                                            }
                                                        }"
                                                        @click.away="open = false; search = ''"
                                                        @keydown.escape="open = false; search = ''"
                                                    >
                                                        <!-- Hidden Input -->
                                                        <input type="hidden" id="edit_role_id" name="role_id" :value="selectedId">

                                                        <!-- Trigger Button -->
                                                        <button
                                                            type="button"
                                                            @click="openDropdown()"
                                                            class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 text-sm text-left flex items-center justify-between gap-2 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10"
                                                            :class="open ? 'border-brand-300 ring-2 ring-brand-500/10' : ''"
                                                        >
                                                            <span
                                                                :class="selectedId ? 'text-gray-800 dark:text-white/90' : 'text-gray-400'"
                                                                x-text="selectedName"
                                                                class="capitalize truncate"
                                                            ></span>
                                                            <svg
                                                                class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform duration-200"
                                                                :class="open ? 'rotate-180' : ''"
                                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            >
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                            </svg>
                                                        </button>

                                                        <!-- Dropdown -->
                                                        <div
                                                            x-show="open"
                                                            x-transition:enter="transition ease-out duration-100"
                                                            x-transition:enter-start="opacity-0 transform scale-95"
                                                            x-transition:enter-end="opacity-100 transform scale-100"
                                                            x-transition:leave="transition ease-in duration-75"
                                                            x-transition:leave-start="opacity-100 transform scale-100"
                                                            x-transition:leave-end="opacity-0 transform scale-95"
                                                            class="absolute z-50 mt-1 w-full rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-lg overflow-hidden"
                                                            style="display: none;"
                                                        >
                                                            <!-- Search Input -->
                                                            <div class="p-2 border-b border-gray-100 dark:border-gray-800">
                                                                <div class="relative">
                                                                    <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                                    </svg>
                                                                    <input
                                                                        type="text"
                                                                        x-ref="searchInput"
                                                                        x-model="search"
                                                                        @keydown.enter.prevent=""
                                                                        placeholder="Cari..."
                                                                        class="w-full rounded-md border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 py-1.5 pl-8 pr-3 text-sm text-gray-800 dark:text-white/90 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10"
                                                                    >
                                                                </div>
                                                            </div>

                                                            <!-- Options List -->
                                                            <ul class="max-h-48 overflow-y-auto py-1 custom-scrollbar">
                                                                <template x-for="role in filteredRoles" :key="role.id">
                                                                    <li>
                                                                        <button
                                                                            type="button"
                                                                            @click="select(role)"
                                                                            class="w-full px-3 py-2 text-sm text-left capitalize flex items-center justify-between gap-2 hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors"
                                                                            :class="selectedId == role.id
                                                                                ? 'text-brand-500 bg-brand-50 dark:bg-brand-500/10'
                                                                                : 'text-gray-700 dark:text-gray-300'"
                                                                        >
                                                                            <span x-text="role.name"></span>
                                                                            <svg
                                                                                x-show="selectedId == role.id"
                                                                                class="w-4 h-4 text-brand-500 flex-shrink-0"
                                                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                                            >
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                                            </svg>
                                                                        </button>
                                                                    </li>
                                                                </template>

                                                                <!-- Tidak ada hasil -->
                                                                <li x-show="filteredRoles.length === 0" class="px-3 py-4 text-sm text-center text-gray-400">
                                                                    Tidak ada hasil untuk "<span x-text="search"></span>"
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Saldo -->
                                                <div>
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Saldo</label>
                                                    <input type="number" id="edit_balance" name="balance"
                                                        class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                                                </div>

                                                <!-- Alamat -->
                                                <div class="sm:col-span-2">
                                                    <label class="mb-1.5 block text-xs font-medium text-gray-500 dark:text-gray-400">Alamat Lengkap</label>
                                                    <textarea id="edit_full_address" name="full_address" rows="2"
                                                        class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 py-2 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900 resize-none"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Footer Buttons -->
                                        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-100 dark:border-gray-800 flex-shrink-0">
                                            <button type="button" @click="detailModal.open = false"
                                                class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Konfirmasi Hapus -->
                    <div
                        x-show="deleteModal.open"
                        @keydown.escape.window="deleteModal.open = false"
                        class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5"
                        style="display: none;">
                        <!-- Backdrop lebih ringan -->
                        <div
                            @click="deleteModal.open = false"
                            class="fixed inset-0 h-full w-full bg-gray-900/30"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                        ></div>

                        <!-- Modal Content - lebih kecil -->
                        <div
                            @click.stop=""
                            class="relative w-full max-w-sm rounded-2xl bg-white p-5 shadow-xl dark:bg-gray-900"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                        >
                            <!-- Icon Danger - lebih kecil -->
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-50 dark:bg-red-500/15">
                                <svg class="h-6 w-6 text-red-600 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                                </svg>
                            </div>

                            <!-- Title & Message -->
                            <div class="mt-3 text-center">
                                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                                    Hapus Program Kursus
                                </h3>
                                <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400">
                                    Hapus
                                    <span class="font-medium text-gray-800 dark:text-white/90" x-text="'&quot;' + deleteModal.name + '&quot;'"></span>?
                                    Tindakan ini tidak dapat dibatalkan.
                                </p>
                            </div>

                            <!-- Footer Buttons -->
                            <div class="mt-5 flex gap-3">
                                <button
                                    @click="deleteModal.open = false"
                                    type="button"
                                    class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]"
                                >
                                    Batal
                                </button>
                                <button
                                    @click="confirmDelete()"
                                    :disabled="deleteModal.loading"
                                    type="button"
                                    class="flex-1 flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-red-700 disabled:opacity-50"
                                >
                                    <span x-show="deleteModal.loading" class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                                    <span x-text="deleteModal.loading ? 'Menghapus...' : 'Ya, Hapus'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('userTable', () => ({
        search       : '',
        statusFilter : '',
        sortColumn   : 'name',
        sortDirection: 'asc',
        currentPage  : 1,
        perPage      : 10,
        allData      : [],
        isLoading    : false,
        totalEntries : 0,
        totalFiltered: 0,
        lastPage     : 1,

        detailModal: {
            open : false,
            user : {},
            roles: []
        },

        deleteModal: {
            open   : false,
            id     : null,
            name   : '',
            loading: false
        },

        init() {
            this.loadData();
            this.$watch('perPage', () => { this.currentPage = 1; this.loadData(); });
            this.$watch('search', () => { this.currentPage = 1; this.loadData(); });
            this.$watch('statusFilter', () => { this.currentPage = 1; this.loadData(); });
            this.$watch('sortColumn', () => this.loadData());
            this.$watch('sortDirection', () => this.loadData());

            // Otomatis dispatch close-detail-modal saat modal ditutup
            this.$watch('detailModal.open', (value) => {
                if (!value) {
                    window.dispatchEvent(new CustomEvent('close-detail-modal'));
                }
            });

            window.addEventListener('user-data-updated', () => {
                this.loadData();
                this.detailModal.open = false;
            });
        },

        async loadData() {
            this.isLoading = true;
            try {
                const response     = await fetch(`{{ route('users.data') }}?search=${this.search}&status=${this.statusFilter}&sort_column=${this.sortColumn}&sort_direction=${this.sortDirection}&per_page=${this.perPage}&page=${this.currentPage}`);
                const data         = await response.json();
                this.allData       = data.data;
                this.totalEntries  = data.recordsTotal;
                this.totalFiltered = data.recordsFiltered;
                this.currentPage   = data.current_page;
                this.lastPage      = data.last_page;
            } catch (error) {
                console.error('Error:', error);
                showToast('Gagal memuat data', 'error');
            } finally {
                this.isLoading = false;
            }
        },

        get filteredData() { return this.allData; },
        get paginatedData() { return this.filteredData; },
        get startEntry() { return ((this.currentPage - 1) * this.perPage) + 1; },
        get endEntry() {
            const end = this.currentPage * this.perPage;
            return end > this.totalFiltered ? this.totalFiltered : end;
        },
        get totalPages() { return Math.ceil(this.totalFiltered / this.perPage); },
        get pagesAroundCurrent() {
            let pages = [];
            const startPage = Math.max(2, this.currentPage - 2);
            const endPage   = Math.min(this.totalPages - 1, this.currentPage + 2);
            for (let i = startPage; i <= endPage; i++) pages.push(i);
            return pages;
        },

        goToPage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
                this.loadData();
            }
        },
        nextPage() { if (this.currentPage < this.totalPages) { this.currentPage++; this.loadData(); } },
        prevPage() { if (this.currentPage > 1) { this.currentPage--; this.loadData(); } },
        sortBy(column) {
            if (this.sortColumn === column) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortDirection = 'asc';
                this.sortColumn    = column;
            }
            this.loadData();
        },

        formatRupiah(value) {
            if (!value || value == 0) return '0';
            return new Intl.NumberFormat('id-ID').format(value);
        },

        getRoleName(roleId) {
            const role = this.detailModal.roles.find(r => r.id == roleId);
            return role ? role.name : '-';
        },

        viewDetail(id) {
            fetch(`/admin/users/${id}`)
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.detailModal.user  = data.data;
                        this.detailModal.roles = data.roles;
                        this.detailModal.open  = true;

                        // ← Kirim roles ke dropdown component
                        window.dispatchEvent(new CustomEvent('roles-loaded', {
                            detail: { roles: data.roles }
                        }));

                        // ← Dispatch event set role
                        window.dispatchEvent(new CustomEvent('set-role', {
                            detail: {
                                id  : data.data.role_id,
                                name: data.roles.find(r => r.id == data.data.role_id)?.name ?? '-'
                            }
                        }));

                        // Isi form edit setelah modal terbuka
                        this.$nextTick(() => {
                            $('#edit_user_id').val(data.data.id);
                            $('#edit_name').val(data.data.name);
                            $('#edit_email').val(data.data.email);
                            $('#edit_role_id').val(data.data.role_id).trigger('change');
                            $('#edit_balance').val(data.data.balance || 0);
                            $('#edit_full_name').val(data.data.full_name);
                            $('#edit_place_of_birth').val(data.data.place_of_birth);
                            $('#edit_date_of_birth').val(data.data.date_of_birth);
                            $('#edit_full_address').val(data.data.full_address);
                            $('#edit_wa_number').val(data.data.wa_number);
                            $('#edit_is_active').val(data.data.is_active ? '1' : '0');

                            if (data.data.image) {
                                $('#edit-preview-img').attr('src', '/' + data.data.image);
                                $('#edit-photo-preview').removeClass('hidden');
                            } else {
                                $('#edit-photo-preview').addClass('hidden');
                            }
                        });
                    }
                })
                .catch(() => showToast('Gagal memuat data user', 'error'));
        },

        getStatusBadge(status) {
            if (status) {
                return `<span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 dark:bg-green-500/15 dark:text-green-500">Active</span>`;
            }
            return `<span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-700 dark:bg-red-500/15 dark:text-red-500">Inactive</span>`;
        },

        deleteRow(id, name) {
            this.deleteModal.id   = id;
            this.deleteModal.name = name;
            this.deleteModal.open = true;
        },

        confirmDelete() {
            this.deleteModal.loading = true;
            fetch(`/admin/users/${this.deleteModal.id}`, {
                method : 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    this.deleteModal.open = false;
                    this.loadData();
                } else {
                    showToast(data.error || 'Gagal menghapus', 'error');
                }
            })
            .catch(() => showToast('Terjadi kesalahan', 'error'))
            .finally(() => { this.deleteModal.loading = false; });
        }
    }));
});

document.addEventListener('DOMContentLoaded', () => {
    // Submit form edit user
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var userId   = $('#edit_user_id').val();
        formData.append('_method', 'PUT');

        var submitBtn    = $(this).find('button[type="submit"]');
        var originalText = submitBtn.html();
        submitBtn.html('<span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span> Saving...').prop('disabled', true);

        $.ajax({
            url        : '/admin/users/' + userId,
            type       : 'POST',
            data       : formData,
            processData: false,
            contentType: false,
            headers    : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success    : function(response) {
                if (response.success) {
                    window.dispatchEvent(new CustomEvent('user-data-updated'));
                    showToast(response.message, 'success');
                }
            },
            error: function(xhr) {
                var error        = xhr.responseJSON;
                var errorMessage = error?.error || error?.message || 'Terjadi kesalahan';
                showToast(errorMessage, 'error');
            },
            complete: function() {
                submitBtn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Preview foto saat upload
    $('#edit_image').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader    = new FileReader();
            reader.onload = function(e) {
                $('#edit-preview-img').attr('src', e.target.result);
                $('#edit-photo-preview').removeClass('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endpush