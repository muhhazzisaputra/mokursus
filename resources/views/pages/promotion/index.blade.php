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
                        Daftar Promo
                    </h3>
                </div>
                <div>
                    <button class="inline-flex items-center justify-center font-medium gap-2 rounded-lg transition px-4 py-3 text-sm bg-brand-500 text-white shadow-theme-xs hover:bg-brand-600 disabled:bg-brand-300"
                            type="button"
                            @click="$dispatch('open-form-in-modal')">
                        Tambah Promo
                    </button>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-800 sm:p-6">
            <div class="space-y-6">
                <div class="overflow-hidden" x-data="promoTable()">
                    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-start">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" placeholder="Search..." 
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
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400 no-wrap">User Promo</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400 no-wrap">Kode Promo</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400 no-wrap">Nama Promo</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-right border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-end w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400">Nominal</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400 no-wrap">Mulai</p>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-left border border-gray-100 dark:border-white/[0.05]">
                                        <div class="flex items-center justify-between w-full">
                                            <p class="font-medium text-gray-700 text-theme-xs dark:text-gray-400 no-wrap">Berakhir</p>
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
                                <template x-for="(promo, index) in paginatedData" :key="promo.id">
                                    <tr class="border-t border-gray-100 dark:border-white/[0.5]">
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="startEntry + index"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90" x-text="promo.user"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="promo.promo_code"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="promo.name"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-right">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="promo.promo_value"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="promo.start_date"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">
                                            <p class="text-theme-sm text-gray-700 dark:text-gray-400" x-text="promo.end_date"></p>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button @click="editRow(promo.id)" class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500" title="Edit">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0911 3.53206C16.2124 2.65338 14.7878 2.65338 13.9091 3.53206L5.6074 11.8337C5.29899 12.1421 5.08687 12.5335 4.99684 12.9603L4.26177 16.445C4.20943 16.6931 4.286 16.9508 4.46529 17.1301C4.64458 17.3094 4.90232 17.3859 5.15042 17.3336L8.63507 16.5985C9.06184 16.5085 9.45324 16.2964 9.76165 15.988L18.0633 7.68631C18.942 6.80763 18.942 5.38301 18.0633 4.50433L17.0911 3.53206ZM14.9697 4.59272C15.2626 4.29982 15.7375 4.29982 16.0304 4.59272L17.0027 5.56499C17.2956 5.85788 17.2956 6.33276 17.0027 6.62565L16.1043 7.52402L14.0714 5.49109L14.9697 4.59272ZM13.0107 6.55175L6.66806 12.8944C6.56526 12.9972 6.49455 13.1277 6.46454 13.2699L5.96704 15.6283L8.32547 15.1308C8.46772 15.1008 8.59819 15.0301 8.70099 14.9273L15.0436 8.58468L13.0107 6.55175Z" fill="currentColor" />
                                                    </svg>
                                                </button>
                                                <button @click="deleteRow(promo.id,promo.title)" class="text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500" title="Hapus">
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

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('promoTable', () => ({
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

        init() {
            this.loadData();
            this.$watch('perPage', () => { this.currentPage = 1; this.loadData(); });
            this.$watch('search', () => { this.currentPage = 1; this.loadData(); });
            this.$watch('statusFilter', () => { this.currentPage = 1; this.loadData(); });
            this.$watch('sortColumn', () => this.loadData());
            this.$watch('sortDirection', () => this.loadData());
        },

        async loadData() {
            this.isLoading = true;
            try {
                const response     = await fetch(`{{ route('promotions.data') }}?search=${this.search}&status=${this.statusFilter}&sort_column=${this.sortColumn}&sort_direction=${this.sortDirection}&per_page=${this.perPage}&page=${this.currentPage}`);
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
        }
    }));
});
</script>
@endpush