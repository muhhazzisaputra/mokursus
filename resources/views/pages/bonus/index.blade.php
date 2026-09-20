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
                        Daftar Bonus
                    </h3>
                </div>
                <div>
                    <button class="inline-flex items-center justify-center font-medium gap-2 rounded-lg transition px-4 py-3 text-sm bg-brand-500 text-white shadow-theme-xs hover:bg-brand-600 disabled:bg-brand-300"
                            type="button"
                            @click="$dispatch('open-form-in-modal')">
                        Tambah Bonus
                    </button>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-800 sm:p-6">
            <div class="space-y-6">
                <div class="overflow-hidden" x-data="bonusTable()">
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
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400 no-wrap">Tipe User</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400 no-wrap">Nama User</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400 no-wrap">Nama Peserta</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-right border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-end w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Nilai Bonus</p>
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
                                <template x-for="(bonus, index) in paginatedData" :key="bonus.id">
                                    <tr class="border-t border-gray-100 dark:border-white/[0.5]">
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="startEntry + index"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90" x-text="bonus.role_id"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="bonus.user_name"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="bonus.member_name"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-right">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="bonus.bonus_value"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button @click="editRow(bonus.id)" class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500" title="Edit">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0911 3.53206C16.2124 2.65338 14.7878 2.65338 13.9091 3.53206L5.6074 11.8337C5.29899 12.1421 5.08687 12.5335 4.99684 12.9603L4.26177 16.445C4.20943 16.6931 4.286 16.9508 4.46529 17.1301C4.64458 17.3094 4.90232 17.3859 5.15042 17.3336L8.63507 16.5985C9.06184 16.5085 9.45324 16.2964 9.76165 15.988L18.0633 7.68631C18.942 6.80763 18.942 5.38301 18.0633 4.50433L17.0911 3.53206ZM14.9697 4.59272C15.2626 4.29982 15.7375 4.29982 16.0304 4.59272L17.0027 5.56499C17.2956 5.85788 17.2956 6.33276 17.0027 6.62565L16.1043 7.52402L14.0714 5.49109L14.9697 4.59272ZM13.0107 6.55175L6.66806 12.8944C6.56526 12.9972 6.49455 13.1277 6.46454 13.2699L5.96704 15.6283L8.32547 15.1308C8.46772 15.1008 8.59819 15.0301 8.70099 14.9273L15.0436 8.58468L13.0107 6.55175Z" fill="currentColor" />
                                                    </svg>
                                                </button>
                                                <button @click="deleteRow(bonus.id,bonus.name)" class="text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500" title="Hapus">
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
                        class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5 bg-gray-900/50 backdrop-blur-sm dark:bg-black/70 dark:backdrop-blur-sm""
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

                        <!-- Hapus data, Modal Content - lebih kecil -->
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
                                    Hapus Bonus
                                </h3>
                                <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400">
                                    Yakin ingin Hapus ?
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

<!-- Modal Structure -->
<div id="modalContainer" x-data="{
    open: false,
    init() {
        this.$watch('open', value => {
            if (value) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'unset';
            }
        });

        // Event listener untuk membuka modal
        window.addEventListener('open-form-in-modal', (e) => {
            // Jika ada detail id, berarti mode edit
            if (e.detail && e.detail.id) {
                // Jangan reset form jika mode edit
                this.open = true;
            } else {
                // Mode tambah
                resetForm();
                this.open = true;
            }
        });
        
        // Event listener untuk menutup modal
        window.addEventListener('close-form-in-modal', () => {
            this.open = false;
        });
    }
}" 
x-show="open" 
@keydown.escape.window="open = false" 
class="modal fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5" 
@open-form-in-modal.window="open = true; resetForm()" 
style="display: none;">

    <!-- Backdrop -->
    <div @click="open = false" class="fixed inset-0 h-full w-full bg-gray-900/40 backdrop-blur-md dark:bg-black/60 dark:backdrop-blur-md"  
            x-transition:enter="transition ease-out duration-200" 
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100" 
            x-transition:leave="transition ease-in duration-200" 
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0">
    </div>

    <!-- Modal Content -->
    <div @click.stop="" class="relative w-full rounded-3xl bg-white dark:bg-gray-900 max-w-[500px]" 
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
        <div class="relative w-full rounded-3xl bg-white p-4 dark:bg-gray-900 sm:p-6 lg:p-8 custom-scrollbar">
            <form id="bonusForm" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="bonus_id" name="bonus_id" x-ref="bonusId">

                <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                    <span id="modal-title">Tambah Bonus</span>
                </h4>

                <div class="flex items-center gap-4 mb-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400 w-28 flex-shrink-0 mb-1">
                        Tipe <span class="text-red-500">*</span>
                    </label>
                    <div class="flex-1">
                        <select id="bonus_type" name="bonus_type"
                            class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:bg-gray-900">
                            <option value="">-Pilih-</option>
                            <option value="1">Admin</option>
                            <option value="3">Trainer</option>
                        </select>
                        <div id="error-tipe" class="mokursus-error-msg mt-1"></div>
                    </div>
                </div>

                <!-- NAMA USER - Dengan role_id dinamis dari bonus_type -->
                <div class="flex items-center gap-4 mb-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400 w-28 flex-shrink-0">
                        Nama User <span class="text-red-500">*</span>
                    </label>
                    <div class="flex-1">
                        <div x-data="{
                            dropdownOpen: false,
                            dropdownSearch: '',
                            dropdownResults: [],
                            dropdownLoading: false,
                            selectedId: null,
                            selectedName: '',
                            debounceTimer: null,
                            selectedRole: '',

                            getRoleId() {
                                return this.selectedRole || '';
                            },

                            getRoleName(roleId) {
                                const roleMap = {
                                    '1': 'Admin',
                                    '3': 'Trainer'
                                };
                                return roleMap[roleId] || '';
                            },

                            onSearch() {
                                clearTimeout(this.debounceTimer);
                                
                                const roleId = this.getRoleId();
                                
                                if (!roleId || roleId === '') {
                                    this.dropdownResults = [];
                                    this.dropdownLoading = false;
                                    return;
                                }
                                
                                if (this.dropdownSearch.length === 0) {
                                    this.dropdownResults = [];
                                    this.dropdownLoading = false;
                                    return;
                                }
                                
                                this.dropdownLoading = true;
                                this.debounceTimer = setTimeout(() => {
                                    this.fetchData(this.dropdownSearch);
                                }, 400);
                            },

                            async fetchData(keyword) {
                                try {
                                    const roleId = this.getRoleId();
                                    
                                    if (!roleId || roleId === '') {
                                        this.dropdownResults = [];
                                        this.dropdownLoading = false;
                                        return;
                                    }
                                    
                                    const response = await fetch(`{{ route('bonuses.search') }}?keyword=${encodeURIComponent(keyword)}&role_id=${roleId}`);
                                    const data = await response.json();
                                    
                                    if (data.success) {
                                        this.dropdownResults = data.data;
                                    }
                                } catch (error) {
                                    console.error('Gagal mencari user:', error);
                                } finally {
                                    this.dropdownLoading = false;
                                }
                            },

                            select(user) {
                                this.selectedId = user.id;
                                this.selectedName = user.name;
                                this.dropdownSearch = '';
                                this.dropdownResults = [];
                                this.dropdownOpen = false;

                                document.getElementById('user_id').value = user.id;
                                clearError('user_id', 'error-nama-user');
                            },

                            openDropdown() {
                                const roleId = this.getRoleId();
                                
                                this.dropdownOpen = true;
                                this.dropdownSearch = '';
                                this.dropdownResults = [];
                                
                                this.$nextTick(() => {
                                    const searchInput = this.$refs.searchInput;
                                    if (searchInput) {
                                        if (!roleId || roleId === '') {
                                            searchInput.disabled = true;
                                            searchInput.placeholder = 'Pilih Tipe terlebih dahulu';
                                        } else {
                                            searchInput.disabled = false;
                                            searchInput.placeholder = 'Ketik nama user...';
                                            searchInput.focus();
                                        }
                                    }
                                });
                            },

                            clearSelected() {
                                this.selectedId = null;
                                this.selectedName = '';
                                this.dropdownSearch = '';
                                this.dropdownResults = [];
                                document.getElementById('user_id').value = '';
                                this.$nextTick(() => {
                                    if (this.$refs.searchInput) {
                                        this.$refs.searchInput.focus();
                                    }
                                });
                            },

                            init() {
                                window.addEventListener('set-user', (e) => {
                                    console.log('set-user event received:', e.detail); // Debugging
                                    
                                    if (e.detail && e.detail.id) {
                                        this.selectedId   = e.detail.user_id;
                                        this.selectedName = e.detail.user_name || '';
                                        document.getElementById('user_id').value = e.detail.user_id;
                                        
                                        // Update dropdown trigger text
                                        const triggerSpan = this.$el.querySelector('.dropdown-trigger span');
                                        if (triggerSpan) {
                                            triggerSpan.textContent = e.detail.user_name || '';
                                            triggerSpan.className = 'text-gray-800 dark:text-white/90 truncate';
                                        }
                                    } else {
                                        this.selectedId  = null;
                                        this.selectedName = '';
                                        document.getElementById('user_id').value = '';
                                    }
                                    
                                    // Tutup dropdown
                                    this.dropdownOpen = false;
                                });

                                // Sync with select element
                                const selectElement = document.getElementById('bonus_type');
                                if (selectElement) {
                                    this.selectedRole = selectElement.value || '';
                                    
                                    selectElement.addEventListener('change', (e) => {
                                        this.selectedRole = e.target.value || '';
                                        
                                        if (this.selectedId) {
                                            this.clearSelected();
                                        }
                                        
                                        const searchInput = this.$refs.searchInput;
                                        if (searchInput) {
                                            if (this.selectedRole && this.selectedRole !== '') {
                                                searchInput.disabled = false;
                                                searchInput.placeholder = `Cari user dengan role ${this.getRoleName(this.selectedRole)}...`;
                                            } else {
                                                searchInput.disabled = true;
                                                searchInput.placeholder = 'Pilih Tipe terlebih dahulu';
                                            }
                                        }
                                        
                                        const triggerSpan = document.querySelector('#dropdown-trigger-btn span');
                                        if (triggerSpan && !this.selectedId) {
                                            if (this.selectedRole && this.selectedRole !== '') {
                                                triggerSpan.textContent = 'Ketik nama user...';
                                                triggerSpan.className = 'text-gray-400 truncate';
                                            } else {
                                                triggerSpan.textContent = 'Pilih Tipe terlebih dahulu';
                                                triggerSpan.className = 'text-yellow-600 dark:text-yellow-400 truncate';
                                            }
                                        }
                                        
                                        if (this.dropdownOpen && this.selectedRole && this.selectedRole !== '' && this.dropdownSearch.length > 0) {
                                            this.onSearch();
                                        } else if (!this.selectedRole || this.selectedRole === '') {
                                            this.dropdownResults = [];
                                        }
                                    });
                                }

                                // Event listener untuk reset
                                window.addEventListener('reset-user-selected', () => {
                                    this.dropdownOpen = false;
                                    this.dropdownSearch = '';
                                    this.dropdownResults = [];
                                    this.selectedId = null;
                                    this.selectedName = '';
                                    clearTimeout(this.debounceTimer);
                                });

                                // Tutup dropdown saat klik di luar
                                document.addEventListener('mousedown', (e) => {
                                    if (this.dropdownOpen && !this.$el.contains(e.target)) {
                                        this.dropdownOpen = false;
                                        this.dropdownSearch = '';
                                        this.dropdownResults = [];
                                        this.dropdownLoading = false;
                                        clearTimeout(this.debounceTimer);
                                    }
                                });

                                // Watch untuk selectedId
                                this.$watch('selectedId', (value) => {
                                    if (value) {
                                        clearError('user_id', 'error-nama-user');
                                    }
                                });
                            }
                        }">
                            <input type="hidden" id="user_id" name="user_id" x-ref="userId" :value="selectedId">

                            <!-- Trigger Button -->
                            <button type="button" @click="openDropdown()" id="dropdown-trigger-btn"
                                class="dropdown-trigger h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 text-sm text-left flex items-center justify-between gap-2 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10"
                                :class="dropdownOpen ? 'border-brand-300 ring-2 ring-brand-500/10' : ''"
                            >
                                <span
                                    :class="selectedId ? 'text-gray-800 dark:text-white/90' : (selectedRole && selectedRole !== '' ? 'text-gray-400' : 'text-gray-400')"
                                    x-text="selectedId ? selectedName : (selectedRole && selectedRole !== '' ? 'Ketik nama user...' : 'Pilih Tipe terlebih dahulu')"
                                    class="truncate"
                                ></span>
                                <div class="flex items-center gap-1 flex-shrink-0">
                                    <span x-show="selectedId !== null" @click.stop="clearSelected()"
                                        class="text-gray-300 hover:text-gray-500 dark:text-gray-600 dark:hover:text-gray-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="dropdownOpen"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="absolute z-50 mt-1 w-[300px] rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-lg overflow-hidden"
                                style="display: none;"
                            >
                                <!-- Search Input -->
                                <div class="p-2 border-b border-gray-100 dark:border-gray-800">
                                    <div class="relative">
                                        <div class="absolute left-2.5 top-1/2 -translate-y-1/2">
                                            <template x-if="dropdownLoading">
                                                <span class="inline-block w-4 h-4 border-2 border-gray-300 border-t-brand-500 rounded-full animate-spin"></span>
                                            </template>
                                            <template x-if="!dropdownLoading">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                            </template>
                                        </div>
                                        <input type="text" x-ref="searchInput" x-model="dropdownSearch"
                                            @input="onSearch()" @keydown.enter.prevent=""
                                            :placeholder="selectedRole && selectedRole !== '' ? 'Ketik nama user...' : 'Pilih Tipe terlebih dahulu'"
                                            class="w-full rounded-md border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 py-1.5 pl-8 pr-3 text-sm text-gray-800 dark:text-white/90 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10"
                                            :disabled="!selectedRole || selectedRole === ''"
                                        >
                                    </div>
                                </div>

                                <!-- Options List -->
                                <ul class="max-h-52 overflow-y-auto py-1 custom-scrollbar">
                                    <!-- Jika role belum dipilih -->
                                    <template x-if="!selectedRole || selectedRole === ''">
                                        <li class="px-3 py-4 text-sm text-center text-yellow-600 dark:text-yellow-400">
                                            ⚠️ Pilih Tipe terlebih dahulu
                                        </li>
                                    </template>

                                    <!-- Jika role sudah dipilih tapi belum ada search -->
                                    <template x-if="selectedRole && selectedRole !== '' && dropdownSearch.length === 0 && !dropdownLoading">
                                        <li class="px-3 py-4 text-sm text-center text-gray-400">
                                            Ketik nama user untuk mencari...
                                        </li>
                                    </template>

                                    <!-- Hasil pencarian -->
                                    <template x-if="dropdownResults.length > 0">
                                        <div>
                                            <li class="px-3 py-1.5 text-xs text-gray-400 border-b border-gray-50 dark:border-gray-800">
                                                Menampilkan <span class="font-medium text-gray-500" x-text="dropdownResults.length"></span> hasil
                                                <span class="text-gray-400"> untuk tipe <span class="font-medium" x-text="getRoleName(selectedRole)"></span></span>
                                                <template x-if="dropdownResults.length === 50">
                                                    <span> — maks. 50, persempit pencarian</span>
                                                </template>
                                            </li>
                                            <template x-for="user in dropdownResults" :key="user.id">
                                                <li>
                                                    <button type="button" @click="select(user)"
                                                        class="w-full px-3 py-2.5 text-sm text-left flex items-center justify-between gap-2 hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors"
                                                        :class="selectedId == user.id
                                                            ? 'text-brand-500 bg-brand-50 dark:bg-brand-500/10'
                                                            : 'text-gray-700 dark:text-gray-300'"
                                                    >
                                                        <div class="flex flex-col">
                                                            <span class="font-medium" x-text="user.name"></span>
                                                        </div>
                                                        <svg x-show="selectedId == user.id" class="w-4 h-4 text-brand-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    </button>
                                                </li>
                                            </template>
                                        </div>
                                    </template>

                                    <!-- Tidak ada hasil -->
                                    <template x-if="selectedRole && selectedRole !== '' && dropdownSearch.length > 0 && dropdownResults.length === 0 && !dropdownLoading">
                                        <li class="px-3 py-4 text-sm text-center text-gray-400">
                                            Tidak ada hasil untuk "<span class="font-medium" x-text="dropdownSearch"></span>"
                                            <span class="block text-xs text-gray-400 mt-1">dengan role <span class="font-medium" x-text="getRoleName(selectedRole)"></span></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                            <div id="error-nama-user" class="mokursus-error-msg mt-1"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400 w-28 flex-shrink-0">
                        Nama Peserta <span class="text-red-500">*</span>
                    </label>
                    <div class="flex-1">
                        <div x-data="{
                            dropdownOpen   : false,
                            dropdownSearch : '',
                            dropdownResults: [],
                            dropdownLoading: false,
                            selectedId     : null,
                            selectedName   : '',
                            debounceTimer  : null,

                            onSearch() {
                                clearTimeout(this.debounceTimer);
                                if (this.dropdownSearch.length === 0) {
                                    this.dropdownResults   = [];
                                    this.dropdownLoading = false;
                                    return;
                                }
                                this.dropdownLoading    = true;
                                this.debounceTimer = setTimeout(() => {
                                    this.fetchData(this.dropdownSearch);
                                }, 400);
                            },

                            async fetchData(keyword) {
                                try {
                                    const response = await fetch(`{{ route('bonuses.search_member') }}?keyword=${encodeURIComponent(keyword)}`);
                                    const data     = await response.json();
                                    if (data.success) {
                                        this.dropdownResults = data.data;
                                    }
                                } catch (error) {
                                    console.error('Gagal mencari peserta:', error);
                                } finally {
                                    this.dropdownLoading = false;
                                }
                            },

                            select(member) {
                                this.selectedId      = member.id;
                                this.selectedName    = member.full_name;
                                this.dropdownSearch  = '';
                                this.dropdownResults = [];
                                this.dropdownOpen    = false;

                                // Simpan id ke hidden input
                                document.getElementById('member_id').value = member.id;
                                clearError('member_id', 'error-nama-member');
                            },

                            openDropdown() {
                                this.dropdownOpen    = true;
                                this.dropdownSearch  = '';
                                this.dropdownResults = [];
                                this.$nextTick(() => this.$refs.searchInput.focus());
                            },

                            clearSelected() {
                                this.selectedId      = null;
                                this.selectedName    = '';
                                this.dropdownSearch  = '';
                                this.dropdownResults = [];
                                document.getElementById('member_id').value        = '';
                                this.$nextTick(() => this.$refs.searchInput.focus());
                            },

                            init() {
                                window.addEventListener('set-peserta', (e) => {
                                    console.log('set-peserta event received:', e.detail); // Debugging
                                    
                                    if (e.detail && e.detail.id) {
                                        this.selectedId = e.detail.id;
                                        this.selectedName = e.detail.name || '';
                                        document.getElementById('member_id').value = e.detail.id;
                                        
                                        // Update dropdown trigger text
                                        const triggerSpan = this.$el.querySelector('.dropdown-trigger span');
                                        if (triggerSpan) {
                                            triggerSpan.textContent = e.detail.name || '';
                                            triggerSpan.className = 'text-gray-800 dark:text-white/90 truncate';
                                        }
                                    } else {
                                        this.selectedId = null;
                                        this.selectedName = '';
                                        document.getElementById('member_id').value = '';
                                    }
                                    
                                    // Tutup dropdown
                                    this.dropdownOpen = false;
                                });

                                window.addEventListener('reset-bonus-form', () => {
                                    this.dropdownOpen    = false;
                                    this.dropdownSearch  = '';
                                    this.dropdownResults = [];
                                    this.selectedId      = null;
                                    this.selectedName    = '';
                                    clearTimeout(this.debounceTimer);
                                });

                                // Tutup dropdown saat klik di luar
                                document.addEventListener('mousedown', (e) => {
                                    if (this.dropdownOpen && !this.$el.contains(e.target)) {
                                        this.dropdownOpen    = false;
                                        this.dropdownSearch  = '';
                                        this.dropdownResults = [];
                                        this.dropdownLoading = false;
                                        clearTimeout(this.debounceTimer);
                                    }
                                });

                                // Watch untuk member_id changes
                                this.$watch('selectedId', (value) => {
                                    if (value) {
                                        clearError('member_id', 'error-nama-alumni');
                                    }
                                });
                            }
                        }">
                    
                            <input type="hidden" id="member_id" name="member_id" x-ref="memberId" :value="selectedId">

                            <!-- Trigger Button -->
                            <button type="button" @click="openDropdown()" id="dropdown-trigger-btn"
                                class="dropdown-trigger h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 text-sm text-left flex items-center justify-between gap-2 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10"
                                :class="dropdownOpen ? 'border-brand-300 ring-2 ring-brand-500/10' : ''"
                            >
                                <span
                                    :class="selectedId ? 'text-gray-800 dark:text-white/90' : 'text-gray-400'"
                                    x-text="selectedId ? selectedName : 'Ketik nama member...'"
                                    class="truncate"
                                ></span>
                                <div class="flex items-center gap-1 flex-shrink-0">
                                    <span x-show="selectedId !== null" @click.stop="clearSelected()"
                                        class="text-gray-300 hover:text-gray-500 dark:text-gray-600 dark:hover:text-gray-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="dropdownOpen"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="absolute z-50 mt-1 w-[300px] rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-lg overflow-hidden"
                                style="display: none;"
                            >
                                <!-- Search Input -->
                                <div class="p-2 border-b border-gray-100 dark:border-gray-800">
                                    <div class="relative">
                                        <div class="absolute left-2.5 top-1/2 -translate-y-1/2">
                                            <template x-if="dropdownLoading">
                                                <span class="inline-block w-4 h-4 border-2 border-gray-300 border-t-brand-500 rounded-full animate-spin"></span>
                                            </template>
                                            <template x-if="!dropdownLoading">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                            </template>
                                        </div>
                                        <input type="text" x-ref="searchInput" x-model="dropdownSearch"
                                            @input="onSearch()" @keydown.enter.prevent=""
                                            placeholder="Ketik nama member..."
                                            class="w-full rounded-md border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 py-1.5 pl-8 pr-3 text-sm text-gray-800 dark:text-white/90 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10">
                                    </div>
                                </div>

                                <!-- Options List -->
                                <ul class="max-h-52 overflow-y-auto py-1 custom-scrollbar">
                                    <template x-if="dropdownSearch.length === 0 && !dropdownLoading">
                                        <li class="px-3 py-4 text-sm text-center text-gray-400">
                                            Ketik nama member untuk mencari...
                                        </li>
                                    </template>

                                    <template x-if="dropdownResults.length > 0">
                                        <div>
                                            <li class="px-3 py-1.5 text-xs text-gray-400 border-b border-gray-50 dark:border-gray-800">
                                                Menampilkan <span class="font-medium text-gray-500" x-text="dropdownResults.length"></span> hasil
                                                <template x-if="dropdownResults.length === 50">
                                                    <span> — maks. 50, persempit pencarian</span>
                                                </template>
                                            </li>
                                            <template x-for="member in dropdownResults" :key="member.id">
                                                <li>
                                                    <button type="button" @click="select(member)"
                                                        class="w-full px-3 py-2.5 text-sm text-left flex items-center justify-between gap-2 hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors"
                                                        :class="selectedId == member.id
                                                            ? 'text-brand-500 bg-brand-50 dark:bg-brand-500/10'
                                                            : 'text-gray-700 dark:text-gray-300'"
                                                    >
                                                        <div class="flex flex-col">
                                                            <span class="font-medium" x-text="member.full_name"></span>
                                                        </div>
                                                        <svg x-show="selectedId == member.id" class="w-4 h-4 text-brand-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    </button>
                                                </li>
                                            </template>
                                        </div>
                                    </template>

                                    <template x-if="dropdownSearch.length > 0 && dropdownResults.length === 0 && !dropdownLoading">
                                        <li class="px-3 py-4 text-sm text-center text-gray-400">
                                            Tidak ada hasil untuk "<span class="font-medium" x-text="dropdownSearch"></span>"
                                        </li>
                                    </template>
                                </ul>
                            </div>
                            <div id="error-nama-member" class="mokursus-error-msg mt-1"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400 w-28 flex-shrink-0">
                        Nilai Bonus <span class="text-red-500">*</span>
                    </label>
                    <div class="flex-1">
                        <input type="text" id="bonus_value" name="bonus_value" x-ref="bonus_value"
                            class="h-10 w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-3 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10"
                            placeholder="Nilai Bonus" onkeyup="formatNumber(this)" onblur="onBlurFormat(this)">
                        <div id="error-nilai" class="mokursus-error-msg mt-1"></div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex flex-col-reverse gap-3 mt-6 sm:flex-row sm:items-center sm:justify-end">
                    <button @click="open = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Close
                    </button>
                    <button type="submit"
                        class="flex w-full justify-center px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 hover:bg-brand-600 sm:w-auto">
                        Save
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
    Alpine.data('bonusTable', () => ({
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
            bonus: {},
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

            window.addEventListener('bonus-data-updated', () => {
                this.loadData();
            });

            window.addEventListener('bonus-data-updated', () => {
                this.loadData();
                this.detailModal.open = false;
            });
        },

        async loadData() {
            this.isLoading = true;
            try {
                const response     = await fetch(`{{ route('bonuses.data') }}?search=${this.search}&status=${this.statusFilter}&sort_column=${this.sortColumn}&sort_direction=${this.sortDirection}&per_page=${this.perPage}&page=${this.currentPage}`);
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

        async editRow(id) {
            try {
                this.isLoading = true;
                
                const response = await fetch(`/admin/bonuses/${id}`);
                const data = await response.json();
                
                if (data.success) {
                    const bonus = data.data;
                    
                    console.log('Data bonus:', bonus); // Debugging
                    
                    // Update form values menggunakan jQuery (lebih reliable)
                    $('#bonus_id').val(bonus.id);
                    $('#bonus_type').val(bonus.bonus_type);

                    window.dispatchEvent(new CustomEvent('set-user', {
                        detail: {
                            id  : bonus.user_id,
                            name: bonus.user_name || ''
                        }
                    }));

                    window.dispatchEvent(new CustomEvent('set-peserta', {
                        detail: {
                            id  : bonus.member_id,
                            name: bonus.member_name || ''
                        }
                    }));

                    $('#bonus_value').val(formatNumberDisplay(bonus.bonus_value));
                    
                    // Update modal title
                    $('#modal-title').text('Edit Bonus');                    
                    
                    // Buka modal dengan mengirim ID
                    window.dispatchEvent(new CustomEvent('open-form-in-modal', {
                        detail: { id: bonus.id }
                    }));
                }
            } catch (error) {
                console.error('Error:', error);
                if (typeof showToast === 'function') {
                    showToast('Gagal mengambil data karya alumni', 'error');
                }
            } finally {
                this.isLoading = false;
            }
        },

        deleteRow(id, title) {
            this.deleteModal.id    = id;
            this.deleteModal.title = title;
            this.deleteModal.open  = true;
        },

        confirmDelete() {
            this.deleteModal.loading = true;
            fetch(`/admin/bonuses/${this.deleteModal.id}`, {
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
    // Hapus error saat user mulai mengetik pada input
    $(document).on('input', '#bonus_type, #bonus_value', function() {
        const fieldId = $(this).attr('id');
        const errorMap = {
            'bonus_type' : 'error-tipe',
            'bonus_value': 'error-nilai'
        };
        
        if (errorMap[fieldId]) {
            clearError(fieldId, errorMap[fieldId]);
        }
    });
    
    $('#bonusForm').on('submit', function(e) {
        e.preventDefault();

        // Validasi
        if (!validateForm()) {
            // Scroll ke field pertama yang error
            $('.mokursus-error-msg:visible').first().closest('.grid, .mb-4, .mb-6').find('input, textarea, .dropdown-trigger').first().focus();
            return;
        }
        
        var formData = new FormData(this);
        var bonusId  = $('#bonus_id').val();
        var url      = bonusId ? '/admin/bonuses/' + bonusId : '/admin/bonuses';
        
        if (bonusId) {
            formData.append('_method', 'PUT');
        }
        
        var submitBtn    = $(this).find('button[type="submit"]');
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
                    // Tutup modal
                    window.dispatchEvent(new CustomEvent('close-form-in-modal'));
                    
                    // Refresh data
                    window.dispatchEvent(new CustomEvent('bonus-data-updated'));
                    
                    // Tampilkan notifikasi
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
                
                // Tampilkan error dari server
                if (error && error.errors) {
                    // Tampilkan error per field dari Laravel
                    $.each(error.errors, function(field, messages) {
                        const errorMap = {
                            'member_id'  : 'error-nama-alumni',
                            'title'      : 'error-title',
                            'description': 'error-description'
                        };
                        
                        if (errorMap[field]) {
                            showError('f_' + field, errorMap[field], messages[0]);
                        }
                    });
                } else {
                    var errorMessage = error?.error || error?.message || 'Terjadi kesalahan saat menyimpan data';
                    if (typeof showToast === 'function') {
                        showToast(errorMessage, 'error');
                    } else {
                        alert(errorMessage);
                    }
                }
            },
            complete: function() {
                submitBtn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Validasi form sebelum submit (client-side only)
    function validateForm() {
        let isValid = true;
        
        // Clear semua error terlebih dahulu
        clearAllErrors();
        
        // Validasi tipe
        let bonus_type = $('#bonus_type').val().trim();
        if (bonus_type === '') {
            showError('bonus_type', 'error-tipe', 'Tipe harus dipilih.');
            isValid = false;
        }

        // Validasi Nama user
        let user_id = $('#user_id').val().trim();
        if (user_id === '') {
            showError('user_id', 'error-nama-user', 'Nama User harus dipilih.');
            isValid = false;
        }

        // Validasi Nama peserta
        let member_id = $('#member_id').val().trim();
        if (member_id === '') {
            showError('member_id', 'error-nama-member', 'Nama Peserta harus dipilih.');
            isValid = false;
        }

        // Validasi Nilai bonus
        let bonus_value = $('#bonus_value').val().trim();
        if (bonus_value === '') {
            showError('bonus_value', 'error-nilai', 'Nilai Bonus harus diisi.');
            isValid = false;
        }
        
        return isValid;
    }
})

// Fungsi untuk menampilkan error pada field tertentu
function showError(fieldId, errorId, message) {
    // Style untuk input
    $('#' + fieldId).css({
        'border-color'    : '#ef4444',
        'background-color': '#fef2f2'
    })

    $('#' + fieldId).closest('.flex').find('label').addClass('mb-5')
    
    // Style untuk pesan error
    $('#' + errorId).css({
        'color'     : '#ef4444',
        'font-size' : '12px',
        'margin-top': '4px',
        'display'   : 'block'
    }).text(message)
}

function clearAllErrors() {
    // Reset semua field yang memiliki error user_id error-nama-user, member_id error-nama-member, bonus_value, error-nilai
    const fields   = ['bonus_type', 'user_id', 'member_id', 'bonus_value'];
    const errorIds = ['error-tipe', 'error-nama-user', 'error-nama-member', 'error-nilai'];
    
    fields.forEach(field => {
        $('#' + field).css({'border-color': '', 'background-color': ''});
    });
    
    errorIds.forEach(errorId => {
        $('#' + errorId).css('display', '').text('');
    });
}

// Fungsi untuk menghapus error pada field tertentu (opsional)
function clearError(fieldId, errorId) {
    $('#' + fieldId).css({'border-color': '', 'background-color': ''});
    $('#' + errorId).css('display', '').text('');

    $('.flex label').removeClass('mb-5');
}

function resetForm() {
    // Jangan reset jika sedang edit (cek apakah bonus_id terisi)
    if ($('#bonus_id').val()) {
        // Sedang edit, jangan reset semua
        return;
    }

    $('#bonusForm')[0].reset();

    $('#bonus_type, #user_id, #member_id, #bonus_value').val('');

    // Reset dropdown peserta
    window.dispatchEvent(new CustomEvent('reset-bonus-form'));
    window.dispatchEvent(new CustomEvent('reset-user-selected'));

    // Clear semua error
    clearAllErrors();
}

</script>
@endpush