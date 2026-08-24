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
                        Daftar Trainer
                    </h3>
                </div>
                <div>
                    <button class="inline-flex items-center justify-center font-medium gap-2 rounded-lg transition px-4 py-3 text-sm bg-brand-500 text-white shadow-theme-xs hover:bg-brand-600 disabled:bg-brand-300"
                            type="button"
                            @click="$dispatch('open-form-in-modal')">
                        Tambah Trainer
                    </button>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-800 sm:p-6">
            <div class="space-y-6">
                <div class="overflow-hidden" x-data="trainerTable()">
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
                                <svg class="w-4 h-4" :class="{ 'animate-spin': isLoading }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <th class="px-4 py-3 text-center border border-gray-100 dark:border-white/[0.05] w-16">
                                        <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">No</p>
                                    </th>
                                    <th class="px-4 py-3 text-center border border-gray-100 dark:border-white/[0.05] w-20">
                                        <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Foto</p>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">ID Card</p>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full cursor-pointer" @click="sortBy('name')">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Nama Trainer</p>
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
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full cursor-pointer" @click="sortBy('date_of_entry')">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Tgl Masuk</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Alamat</p>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">No. Hp</p>
                                    </th>
                                    <th class="px-4 py-3 text-center border border-gray-100 dark:border-white/[0.05] w-24">
                                        <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Status</p>
                                    </th>
                                    <th class="px-4 py-3 text-center border border-gray-100 dark:border-white/[0.05] w-24">
                                        <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Aksi</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(trainer, index) in paginatedData" :key="trainer.id">
                                    <tr class="border-t border-gray-100 dark:border-white/[0.5]">
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="startEntry + index"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <template x-if="trainer.photo">
                                                <img :src="'/' + trainer.photo"
                                                    class="w-10 h-10 object-cover rounded-lg mx-auto cursor-pointer hover:opacity-80 hover:ring-2 hover:ring-brand-500 transition-all"
                                                    @click="previewPhoto(trainer.name, trainer.photo)"
                                                    title="Klik untuk memperbesar">
                                            </template>
                                            <template x-if="!trainer.photo">
                                                <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            </template>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90" x-text="trainer.card_id || '-'"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90" x-text="trainer.name"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="trainer.date_of_entry"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="trainer.address || '-'"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="trainer.wa_number || '-'"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <span x-html="getStatusBadge(trainer.is_active)"></span>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button @click="editRow(trainer.id)" class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500" title="Edit">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0911 3.53206C16.2124 2.65338 14.7878 2.65338 13.9091 3.53206L5.6074 11.8337C5.29899 12.1421 5.08687 12.5335 4.99684 12.9603L4.26177 16.445C4.20943 16.6931 4.286 16.9508 4.46529 17.1301C4.64458 17.3094 4.90232 17.3859 5.15042 17.3336L8.63507 16.5985C9.06184 16.5085 9.45324 16.2964 9.76165 15.988L18.0633 7.68631C18.942 6.80763 18.942 5.38301 18.0633 4.50433L17.0911 3.53206ZM14.9697 4.59272C15.2626 4.29982 15.7375 4.29982 16.0304 4.59272L17.0027 5.56499C17.2956 5.85788 17.2956 6.33276 17.0027 6.62565L16.1043 7.52402L14.0714 5.49109L14.9697 4.59272ZM13.0107 6.55175L6.66806 12.8944C6.56526 12.9972 6.49455 13.1277 6.46454 13.2699L5.96704 15.6283L8.32547 15.1308C8.46772 15.1008 8.59819 15.0301 8.70099 14.9273L15.0436 8.58468L13.0107 6.55175Z" fill="currentColor" />
                                                    </svg>
                                                </button>
                                                <button @click="deleteRow(trainer.id, trainer.name)" class="text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500" title="Hapus">
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

                    <!-- Modal Konfirmasi Hapus -->
                    <div
                        x-show="deleteModal.open"
                        @keydown.escape.window="deleteModal.open = false"
                        class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5"
                        style="display: none;"
                    >
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
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-50 dark:bg-red-500/15">
                                <svg class="h-6 w-6 text-red-600 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                                </svg>
                            </div>

                            <div class="mt-3 text-center">
                                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                                    Hapus Trainer
                                </h3>
                                <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400">
                                    Hapus
                                    <span class="font-medium text-gray-800 dark:text-white/90" x-text="'&quot;' + deleteModal.name + '&quot;'"></span>?
                                    Tindakan ini tidak dapat dibatalkan.
                                </p>
                            </div>

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

                    <!-- Modal Preview Foto -->
                    <div
                        x-show="photoModal.open"
                        @keydown.escape.window="photoModal.open = false"
                        @click="photoModal.open = false"
                        class="fixed inset-0 z-99999 flex items-center justify-center p-5"
                        style="display: none;">
                        <!-- Backdrop -->
                        <div
                            class="fixed inset-0 h-full w-full bg-gray-900/30"
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
                            class="relative z-10"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90">
                            <!-- Card -->
                            <div class="relative rounded-3xl bg-white dark:bg-gray-900 shadow-2xl overflow-hidden w-72">

                                <!-- Tombol Close -->
                                <button
                                    @click="photoModal.open = false"
                                    class="absolute top-3 right-3 z-20 flex h-8 w-8 items-center justify-center rounded-full bg-white/80 backdrop-blur-sm text-gray-500 shadow hover:bg-white hover:text-gray-700 dark:bg-gray-800/80 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors"
                                >
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z" fill="currentColor"/>
                                    </svg>
                                </button>

                                <!-- Foto -->
                                <div class="w-full bg-gray-100 dark:bg-gray-800">
                                    <template x-if="photoModal.photo">
                                        <img
                                            :src="'/' + photoModal.photo"
                                            :alt="photoModal.name"
                                            class="w-full h-64 object-cover"
                                        >
                                    </template>
                                    <template x-if="!photoModal.photo">
                                        <div class="flex flex-col items-center justify-center w-full h-64 gap-3">
                                            <svg class="w-20 h-20 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="text-sm font-medium text-gray-400 dark:text-gray-500">No Image</p>
                                        </div>
                                    </template>
                                </div>

                                <!-- Card Body - Nama & Info -->
                                <div class="px-5 py-4 text-center border-t border-gray-100 dark:border-gray-800">
                                    <p class="text-base font-semibold text-gray-800 dark:text-white/90" x-text="photoModal.name"></p>
                                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Trainer Mokursus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Tambah/Edit Trainer -->
<div id="modalContainer" x-data="{
                    open: false,
                    init() {
                        this.$watch('open', value => {
                            document.body.style.overflow = value ? 'hidden' : 'unset';
                        });

                        window.addEventListener('open-form-in-modal', () => {
                            this.open = true;
                            resetForm();
                            loadCourseList();
                        });

                        window.addEventListener('close-form-in-modal', () => {
                            this.open = false;
                        });
                    }
                }"
                x-show="open"
                @keydown.escape.window="open = false"
                class="modal fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5"
                style="display: none;">

    <!-- Backdrop -->
    <div @click="open = false" class="fixed inset-0 h-full w-full bg-gray-900/30 backdrop-blur-[32px]"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
    </div>

    <!-- Modal Content -->
    <div @click.stop="" class="relative w-full rounded-3xl bg-white dark:bg-gray-900 max-w-[584px] max-h-[90vh] flex flex-col"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95">

        <!-- Close Button -->
        <button @click="open = false" class="absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z" fill="currentColor"></path>
            </svg>
        </button>

        <!-- Modal Body -->
        <div class="relative w-full rounded-3xl bg-white p-4 dark:bg-gray-900 sm:p-6 lg:p-8 overflow-y-auto custom-scrollbar">
            <form id="trainerForm" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="trainer_id" name="trainer_id">

                <h4 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">
                    <span id="modal-title">Tambah Trainer</span>
                </h4>

                <!-- Tab Navigation -->
                <div x-data="{ activeTab: 'data' }" x-init="$watch('activeTab', () => {})" @reset-tab.window="activeTab = 'data'">
                    <div class="border-b border-gray-200 dark:border-gray-800 mb-4">
                        <nav class="-mb-px flex space-x-2">
                            <button type="button"
                                @click="activeTab = 'data'"
                                :class="activeTab === 'data' ? 'text-brand-500 border-brand-500' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400'"
                                class="inline-flex items-center border-b-2 px-3 py-2 text-sm font-medium transition-colors whitespace-nowrap">
                                Data
                            </button>
                            <button type="button"
                                @click="activeTab = 'kursus'"
                                :class="activeTab === 'kursus' ? 'text-brand-500 border-brand-500' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400'"
                                class="inline-flex items-center border-b-2 px-3 py-2 text-sm font-medium transition-colors whitespace-nowrap">
                                Kursus
                            </button>
                            <button type="button"
                                @click="activeTab = 'fee'"
                                :class="activeTab === 'fee' ? 'text-brand-500 border-brand-500' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400'"
                                class="inline-flex items-center border-b-2 px-3 py-2 text-sm font-medium transition-colors whitespace-nowrap">
                                Fee Mengajar
                            </button>
                        </nav>
                    </div>

                    <!-- Tab: Data -->
                    <div x-show="activeTab === 'data'">
                        <!-- Grid 2 kolom -->
                        <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Nama Trainer <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                    placeholder="Nama lengkap trainer" maxlength="30">
                                <div id="error-name"></div>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="email" name="email"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                    placeholder="example@gmail.com" maxlength="40">
                                <div id="error-email"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tempat Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="place_of_birth" name="place_of_birth"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" maxlength="50">
                                <div id="error-place_of_birth"></div>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="date_of_birth" name="date_of_birth"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <div id="error-date_of_birth"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea id="address" name="address" rows="2"
                                class="dark:bg-dark-900 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                placeholder="Alamat lengkap" maxlength="100" style="resize: none;"></textarea>
                            <div id="error-address"></div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tanggal Masuk <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="date_of_entry" name="date_of_entry"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <div id="error-date_of_entry"></div>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Jenis Kelamin
                                </label>
                                <select id="gender" name="gender"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Status
                                </label>
                                <select id="is_active" name="is_active"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    No. HP / WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="wa_number" name="wa_number"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                    placeholder="08xxxxxxxxxx" maxlength="15">
                                <div id="error-wa_number"></div>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    No. KTP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="ktp_number" name="ktp_number"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                    placeholder="36xxxxxxxxxx" maxlength="20">
                                <div id="error-ktp_number"></div>
                            </div>
                        </div>

                        <!-- Foto Trainer -->
                        <div class="mb-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Foto Trainer
                                    </label>
                                    <div class="mt-2">
                                        <button type="button" onclick="document.getElementById('photo').click()"
                                            class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Pilih Foto
                                        </button>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: JPG, PNG (Max 2MB)</p>
                                </div>
                                <div class="flex items-start">
                                    <div id="photo-preview" class="hidden">
                                        <img id="preview-img" src="#" alt="Preview" class="h-16 w-16 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="photo" name="photo" accept="image/*" class="hidden">
                        </div>
                    </div>

                    <!-- Tab: Kursus -->
                    <div x-show="activeTab === 'kursus'">
                        <div class="overflow-y-auto max-h-[320px] custom-scrollbar">
                            <table class="w-full">
                                <thead class="sticky top-0 bg-white dark:bg-gray-900 z-10">
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-3 px-3 text-left text-sm font-medium text-gray-700 dark:text-gray-400 w-12">#</th>
                                        <th class="py-3 px-3 text-left text-sm font-medium text-gray-700 dark:text-gray-400 w-16">Pilih</th>
                                        <th class="py-3 px-3 text-left text-sm font-medium text-gray-700 dark:text-gray-400">Kursus</th>
                                    </tr>
                                </thead>
                                <tbody id="course-list">
                                    <!-- Diisi via JavaScript saat form dibuka -->
                                    <tr>
                                        <td colspan="3" class="px-3 py-6 text-center text-sm text-gray-400">
                                            Memuat daftar kursus...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab: Fee Mengajar -->
                    <div x-show="activeTab === 'fee'">
                        <div class="mb-4 text-center">
                            <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider underline">KELAS</h5>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-3 px-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-400">Reguler</th>
                                        <th class="py-3 px-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-400">Non Reguler</th>
                                        <th class="py-3 px-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-400">Online</th>
                                        <th class="py-3 px-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-400">Privat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 px-3">
                                            <input type="text" id="fee_reguler" name="fee_reguler"
                                                class="format-number h-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 text-right shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                placeholder="0"
                                                onkeyup="formatNumber(this)" onblur="onBlurFormat(this)">
                                        </td>
                                        <td class="py-3 px-3">
                                            <input type="text" id="fee_non_reguler" name="fee_non_reguler"
                                                class="format-number h-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 text-right shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                placeholder="0"
                                                onkeyup="formatNumber(this)" onblur="onBlurFormat(this)">
                                        </td>
                                        <td class="py-3 px-3">
                                            <input type="text" id="fee_online" name="fee_online"
                                                class="format-number h-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 text-right shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                placeholder="0"
                                                onkeyup="formatNumber(this)" onblur="onBlurFormat(this)">
                                        </td>
                                        <td class="py-3 px-3">
                                            <input type="text" id="fee_privat" name="fee_privat"
                                                class="format-number h-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 text-right shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                placeholder="0"
                                                onkeyup="formatNumber(this)" onblur="onBlurFormat(this)">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex flex-col-reverse gap-3 mt-8 sm:flex-row sm:items-center sm:justify-end">
                    <button @click="open = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto">
                        Close
                    </button>
                    <button type="submit"
                        class="flex w-full justify-center px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('trainerTable', () => ({
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

            deleteModal: {
                open   : false,
                id     : null,
                name   : '',
                loading: false
            },

            photoModal: {
                open : false,
                name : '',
                photo: ''
            },

            init() {
                this.loadData();
                this.$watch('perPage', () => { this.currentPage = 1; this.loadData(); });
                this.$watch('search', () => { this.currentPage = 1; this.loadData(); });
                this.$watch('statusFilter', () => { this.currentPage = 1; this.loadData(); });
                this.$watch('sortColumn', () => this.loadData());
                this.$watch('sortDirection', () => this.loadData());

                window.addEventListener('trainer-data-updated', () => {
                    this.loadData();
                });
            },

            async loadData() {
                this.isLoading = true;
                try {
                    const response     = await fetch(`{{ route('trainers.data') }}?search=${this.search}&status=${this.statusFilter}&sort_column=${this.sortColumn}&sort_direction=${this.sortDirection}&per_page=${this.perPage}&page=${this.currentPage}`);
                    const data         = await response.json();
                    this.allData       = data.data;
                    this.totalEntries  = data.recordsTotal;
                    this.totalFiltered = data.recordsFiltered;
                    this.currentPage   = data.current_page;
                    this.lastPage      = data.last_page;
                } catch (error) {
                    console.error('Error loading data:', error);
                    showToast('Gagal memuat data', 'error');
                } finally {
                    this.isLoading = false;
                }
            },

            get filteredData() {
                return this.allData;
            },

            get paginatedData() {
                return this.filteredData;
            },

            get startEntry() {
                return ((this.currentPage - 1) * this.perPage) + 1;
            },

            get endEntry() {
                const end = this.currentPage * this.perPage;
                return end > this.totalFiltered ? this.totalFiltered : end;
            },

            get totalPages() {
                return Math.ceil(this.totalFiltered / this.perPage);
            },

            get pagesAroundCurrent() {
                let pages = [];
                const startPage = Math.max(2, this.currentPage - 2);
                const endPage = Math.min(this.totalPages - 1, this.currentPage + 2);
                for (let i = startPage; i <= endPage; i++) {
                    pages.push(i);
                }
                return pages;
            },

            goToPage(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                    this.loadData();
                }
            },

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    this.loadData();
                }
            },

            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.loadData();
                }
            },

            sortBy(column) {
                if (this.sortColumn === column) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortDirection = 'asc';
                    this.sortColumn = column;
                }
                this.loadData();
            },

            deleteRow(id, name) {
                this.deleteModal.id   = id;
                this.deleteModal.name = name;
                this.deleteModal.open = true;
            },

            confirmDelete() {
                this.deleteModal.loading = true;

                fetch(`/admin/trainers/${this.deleteModal.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        this.deleteModal.open = false;
                        this.loadData();
                    } else {
                        showToast(data.error || 'Gagal menghapus', 'error');
                    }
                })
                .catch(() => {
                    showToast('Terjadi kesalahan', 'error');
                })
                .finally(() => {
                    this.deleteModal.loading = false;
                });
            },

            editRow(id) {
                window.dispatchEvent(new CustomEvent('open-form-in-modal', { detail: { id: id } }));
                if (typeof editTrainer === 'function') {
                    editTrainer(id);
                }
            },

            getStatusBadge(status) {
                if (status) {
                    return `<span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 dark:bg-green-500/15 dark:text-green-500">Active</span>`;
                }
                return `<span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-700 dark:bg-red-500/15 dark:text-red-500">Inactive</span>`;
            },

            previewPhoto(name, photo) {
                this.photoModal.name  = name;
                this.photoModal.photo = photo;
                this.photoModal.open  = true;
            }
        }));
    });

    document.addEventListener('DOMContentLoaded', () => {
        $(document).on('input', '#name, #email', function() {
            clearErrors();
        });

        $('#photo').on('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-img').attr('src', e.target.result);
                    $('#photo-preview').removeClass('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                $('#photo-preview').addClass('hidden');
            }
        });

        $('#trainerForm').on('submit', function(e) {
            e.preventDefault();

            if (!validateForm()) {
                return;
            }

            var formData = new FormData(this);
            var trainerId = $('#trainer_id').val();
            var url = trainerId ? '/admin/trainers/' + trainerId : '/admin/trainers';

            if (trainerId) {
                formData.append('_method', 'PUT');
            }

            var submitBtn = $(this).find('button[type="submit"]');
            var originalText = submitBtn.html();
            submitBtn.html('<span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span> Saving...').prop('disabled', true);

            $.ajax({
                url        : url,
                type       : 'POST',
                data       : formData,
                processData: false,
                contentType: false,
                headers    : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        closeModal();
                        window.dispatchEvent(new CustomEvent('trainer-data-updated'));

                        if (typeof showToast === 'function') {
                            showToast(response.message, 'success');
                        } else {
                            alert(response.message);
                        }

                        resetForm();
                    }
                },
                error: function(xhr) {
                    var error = xhr.responseJSON;
                    var errorMessage = error?.error || error?.message || 'Terjadi kesalahan saat menyimpan data';
                    showToast(errorMessage, 'error');
                },
                complete: function() {
                    submitBtn.html(originalText).prop('disabled', false);
                }
            });
        });
    });

    // Load daftar kursus ke tab Kursus
    function loadCourseList(selectedIds = []) {
        $.ajax({
            url : '{{ route("courses.data") }}?per_page=999',
            type: 'GET',
            success: function(response) {
                var html = '';
                if (response.data && response.data.length > 0) {
                    response.data.forEach(function(course, index) {
                        var checked = selectedIds.includes(course.id) ? 'checked' : '';
                        var checkedClass = selectedIds.includes(course.id)
                            ? 'border-brand-500 bg-brand-500'
                            : 'border-gray-300 dark:border-gray-700 bg-transparent';

                        html += `
                            <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                                <td class="py-3 px-3 text-sm text-gray-500 dark:text-gray-400">${index + 1}</td>
                                <td class="py-3 px-3">
                                    <label class="flex cursor-pointer items-center">
                                        <div class="relative">
                                            <input type="checkbox"
                                                name="course_ids[]"
                                                value="${course.id}"
                                                class="sr-only course-checkbox"
                                                ${checked}
                                                onchange="toggleCheckboxStyle(this)">
                                            <div class="flex h-5 w-5 items-center justify-center rounded-md border-[1.25px] hover:border-brand-500 transition-colors ${checkedClass}">
                                                <svg class="${checked ? '' : 'hidden'} check-icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white" stroke-width="1.94437" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                </td>
                                <td class="py-3 px-3 text-sm text-gray-800 dark:text-white/90">${course.name}</td>
                            </tr>`;
                    });
                } else {
                    html = '<tr><td colspan="3" class="px-3 py-6 text-center text-sm text-gray-400">Tidak ada kursus tersedia</td></tr>';
                }
                $('#course-list').html(html);
            },
            error: function() {
                $('#course-list').html('<tr><td colspan="3" class="px-3 py-6 text-center text-sm text-red-400">Gagal memuat daftar kursus</td></tr>');
            }
        });
    }

    // Toggle style checkbox saat diklik
    function toggleCheckboxStyle(input) {
        var box = $(input).siblings('div');
        var icon = box.find('.check-icon');
        if (input.checked) {
            box.removeClass('border-gray-300 dark:border-gray-700 bg-transparent')
            .addClass('border-brand-500 bg-brand-500');
            icon.removeClass('hidden');
        } else {
            box.removeClass('border-brand-500 bg-brand-500')
            .addClass('border-gray-300 dark:border-gray-700 bg-transparent');
            icon.addClass('hidden');
        }
    }

    function editTrainer(id) {
        $.ajax({
            url: '/admin/trainers/' + id,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    var trainer = response.data;
                    $('#trainer_id').val(trainer.id);
                    $('#name').val(trainer.name);
                    $('#email').val(trainer.email);
                    $('#place_of_birth').val(trainer.place_of_birth);
                    $('#date_of_birth').val(trainer.date_of_birth);
                    $('#address').val(trainer.address);
                    $('#date_of_entry').val(trainer.date_of_entry);
                    $('#gender').val(trainer.gender);
                    $('#is_active').val((trainer.is_active=='1') ? '1' : '0');
                    $('#wa_number').val(trainer.wa_number);
                    $('#ktp_number').val(trainer.ktp_number);

                    if (trainer.photo) {
                        $('#preview-img').attr('src', '/' + trainer.photo);
                        $('#photo-preview').removeClass('hidden');
                    } else {
                        $('#photo-preview').addClass('hidden');
                    }

                    // Fee
                    $('#fee_reguler').val(formatNumberDisplay(trainer.fee_reguler));
                    $('#fee_non_reguler').val(formatNumberDisplay(trainer.fee_non_reguler));
                    $('#fee_online').val(formatNumberDisplay(trainer.fee_online));
                    $('#fee_privat').val(formatNumberDisplay(trainer.fee_privat));

                    loadCourseList(trainer.course_ids || []);

                    $('#modal-title').text('Edit Trainer');
                }
            },
            error: function() {
                showToast('Gagal mengambil data trainer', 'error');
            }
        });
    }

    function validateForm() {
        clearErrors();
        let isValid = true;

        let name           = $('#name').val().trim();
        let email          = $('#email').val().trim();
        let place_of_birth = $('#place_of_birth').val().trim();
        let date_of_birth  = $('#date_of_birth').val().trim();
        let address        = $('#address').val().trim();
        let date_of_entry  = $('#date_of_entry').val().trim();
        let wa_number      = $('#wa_number').val().trim();
        let ktp_number     = $('#ktp_number').val().trim();

        if (name === '') {
            showError('name', 'error-name', 'Nama Trainer wajib diisi');
            isValid = false;
        }

        if (email === '') {
            showError('email', 'error-email', 'Email wajib diisi');
            isValid = false;
        }

        if (place_of_birth === '') {
            showError('place_of_birth', 'error-place_of_birth', 'Tempat Lahir wajib diisi');
            isValid = false;
        }

        if (date_of_birth === '') {
            showError('date_of_birth', 'error-date_of_birth', 'Tanggal Lahir wajib dipilih');
            isValid = false;
        }

        if (address === '') {
            showError('address', 'error-address', 'Alamat Lengkap wajib diisi');
            isValid = false;
        }

        if (date_of_entry === '') {
            showError('date_of_entry', 'error-date_of_entry', 'Tanggal Masuk wajib diisi');
            isValid = false;
        }

        if (wa_number === '') {
            showError('wa_number', 'error-wa_number', 'No. Hp/WhatsApp wajib diisi');
            isValid = false;
        }

        if (ktp_number === '') {
            showError('ktp_number', 'error-ktp_number', 'No. KTP wajib diisi');
            isValid = false;
        }

        return isValid;
    }

    function closeModal() {
        window.dispatchEvent(new CustomEvent('close-form-in-modal'));
    }

    function showError(fieldId, errorId, message) {
        $('#' + fieldId).css({
            'border-color'    : '#ef4444',
            'background-color': '#fef2f2'
        });

        $('#' + errorId).css({
            'color'     : '#ef4444',
            'font-size' : '12px',
            'margin-top': '4px',
            'display'   : 'block'
        }).text(message);
    }

    function clearErrors() {
        $('#name').css({'border-color': '','background-color': ''});
        $('#error-name').css('display', '').text('');

        $('#email').css({'border-color': '','background-color': ''});
        $('#error-email').css('display', '').text('');
    }

    function resetForm() {
        clearErrors();
        $('#trainerForm')[0].reset();
        $('#trainer_id').val('');
        $('#photo-preview').addClass('hidden');
        $('#preview-img').attr('src', '');
        $('#modal-title').text('Tambah Trainer');

        // Reset fee
        $('#fee_reguler, #fee_non_reguler, #fee_online, #fee_privat').val('');
        
        window.dispatchEvent(new CustomEvent('reset-tab'));
    }
</script>
@endpush