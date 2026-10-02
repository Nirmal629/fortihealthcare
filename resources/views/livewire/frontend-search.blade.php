<div>
  <style>
    /* Modern Searchable Dropdown Modal CSS */
    #searchModal .modal-content {
      border-radius: 20px !important;
      border: 1px solid #e2e8f0 !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
      overflow: hidden;
      background: #ffffff !important;
    }
    #searchModal .modal-dialog {
      max-width: 680px !important;
      margin: 2rem auto !important;
    }
    #searchModal .modal-body {
      padding: 0 !important;
    }

    /* Searchable Input Bar */
    #searchModal .searchable-input-wrapper {
      position: relative !important;
      padding: 16px 20px !important;
      border-bottom: 1px solid #e2e8f0 !important;
      display: flex !important;
      align-items: center !important;
      gap: 12px !important;
      background: #ffffff !important;
    }
    #searchModal .search-main-icon {
      font-size: 26px !important;
      color: #f0b334 !important;
      line-height: 1 !important;
      flex-shrink: 0 !important;
    }
    #searchModal .searchcontent {
      border: none !important;
      box-shadow: none !important;
      font-size: 17px !important;
      font-weight: 500 !important;
      width: 100% !important;
      outline: none !important;
      background: transparent !important;
      color: #0f172a !important;
      padding: 0 !important;
    }
    #searchModal .searchcontent::placeholder {
      color: #94a3b8 !important;
      font-weight: 400 !important;
      font-size: 15px !important;
    }
    #searchModal .clear-search-btn {
      background: #f1f5f9 !important;
      border: none !important;
      border-radius: 50% !important;
      width: 26px !important;
      height: 26px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      color: #64748b !important;
      cursor: pointer !important;
      transition: all 0.2s ease !important;
      flex-shrink: 0 !important;
    }
    #searchModal .clear-search-btn:hover {
      background: #e2e8f0 !important;
      color: #0f172a !important;
    }
    #searchModal .btn-close-modal {
      background: #f8fafc !important;
      border: 1px solid #e2e8f0 !important;
      border-radius: 50% !important;
      width: 32px !important;
      height: 32px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      color: #64748b !important;
      cursor: pointer !important;
      transition: all 0.2s ease !important;
      flex-shrink: 0 !important;
      padding: 0 !important;
    }
    #searchModal .btn-close-modal:hover {
      background: #fee2e2 !important;
      color: #ef4444 !important;
      border-color: #fca5a5 !important;
      transform: rotate(90deg) !important;
    }
    #searchModal .btn-close-modal .material-symbols-outlined {
      font-size: 18px !important;
      line-height: 1 !important;
    }

    /* Searchable Dropdown Menu Container */
    #searchModal .searchable-dropdown-menu {
      max-height: 55vh !important;
      overflow-y: auto !important;
      padding: 8px 12px !important;
      background: #ffffff !important;
    }
    #searchModal .dropdown-section-header {
      padding: 8px 12px 6px 12px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      font-size: 12.5px !important;
      font-weight: 600 !important;
      color: #64748b !important;
      text-transform: uppercase !important;
      letter-spacing: 0.5px !important;
    }
    #searchModal .dropdown-section-header .header-label {
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
    }
    #searchModal .dropdown-section-header .material-symbols-outlined {
      font-size: 16px !important;
      color: #f0b334 !important;
    }

    /* Searchable Dropdown Medicine Items */
    #searchModal .searchable-dropdown-list {
      list-style: none !important;
      padding: 0 !important;
      margin: 0 !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 6px !important;
    }
    #searchModal .searchable-dropdown-item {
      border-radius: 12px !important;
      border: 1px solid #f1f5f9 !important;
      background: #ffffff !important;
      transition: all 0.2s ease !important;
      overflow: hidden !important;
    }
    #searchModal .searchable-dropdown-item:hover {
      background: #fffdf7 !important;
      border-color: #f0b334 !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 3px 10px rgba(240, 179, 52, 0.12) !important;
    }
    #searchModal .searchable-dropdown-link {
      display: flex !important;
      align-items: center !important;
      padding: 10px 12px !important;
      text-decoration: none !important;
      color: inherit !important;
      gap: 12px !important;
      width: 100% !important;
    }

    /* Medicine Image Box in Dropdown */
    #searchModal .searchable-med-image {
      width: 52px !important;
      height: 52px !important;
      flex-shrink: 0 !important;
      border-radius: 10px !important;
      overflow: hidden !important;
      border: 1px solid #e2e8f0 !important;
      background: #ffffff !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      padding: 3px !important;
    }
    #searchModal .searchable-med-image img {
      width: 100% !important;
      height: 100% !important;
      object-fit: contain !important;
    }

    /* Medicine Info in Dropdown */
    #searchModal .searchable-med-info {
      flex: 1 !important;
      min-width: 0 !important;
    }
    #searchModal .searchable-med-name {
      font-size: 14.5px !important;
      color: #0f172a !important;
      font-weight: 600 !important;
      margin-bottom: 4px !important;
      line-height: 1.3 !important;
      white-space: nowrap !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
      transition: color 0.2s ease !important;
    }
    #searchModal .searchable-dropdown-item:hover .searchable-med-name {
      color: #d97706 !important;
    }
    #searchModal .searchable-med-meta {
      display: flex !important;
      align-items: center !important;
      flex-wrap: wrap !important;
      gap: 6px !important;
    }
    #searchModal .searchable-category-badge {
      font-size: 11px !important;
      font-weight: 600 !important;
      padding: 2px 7px !important;
      border-radius: 6px !important;
      background: #eff6ff !important;
      color: #1d4ed8 !important;
      border: 1px solid #dbeafe !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 3px !important;
      text-transform: capitalize !important;
    }
    #searchModal .searchable-category-badge .material-symbols-outlined {
      font-size: 13px !important;
    }
    #searchModal .searchable-price-badge {
      font-size: 11.5px !important;
      font-weight: 700 !important;
      padding: 2px 7px !important;
      border-radius: 6px !important;
      background: #ecfdf5 !important;
      color: #059669 !important;
      border: 1px solid #a7f3d0 !important;
    }
    #searchModal .dropdown-item-arrow {
      color: #cbd5e1 !important;
      font-size: 18px !important;
      transition: all 0.2s ease !important;
      flex-shrink: 0 !important;
    }
    #searchModal .searchable-dropdown-item:hover .dropdown-item-arrow {
      color: #f0b334 !important;
      transform: translateX(3px) !important;
    }

    /* History Items in Dropdown */
    #searchModal .history-dropdown-item {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      background: #f8fafc !important;
      border: 1px solid #e2e8f0 !important;
      border-radius: 10px !important;
      padding: 8px 12px !important;
      transition: all 0.2s ease !important;
      margin-bottom: 6px !important;
    }
    #searchModal .history-dropdown-item:hover {
      background: #fffdf7 !important;
      border-color: #f0b334 !important;
      box-shadow: 0 2px 6px rgba(240, 179, 52, 0.1) !important;
    }
    #searchModal .history-dropdown-link {
      text-decoration: none !important;
      color: inherit !important;
    }
    #searchModal .history-dropdown-link:hover .history-med-name {
      color: #d97706 !important;
    }
    #searchModal .history-med-name {
      font-size: 14px !important;
      font-weight: 600 !important;
      color: #1e293b !important;
      white-space: nowrap !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
    }
    #searchModal .history-delete-btn {
      background: transparent !important;
      border: none !important;
      color: #94a3b8 !important;
      cursor: pointer !important;
      padding: 3px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      border-radius: 50% !important;
      width: 22px !important;
      height: 22px !important;
      transition: all 0.2s ease !important;
      flex-shrink: 0 !important;
    }
    #searchModal .history-delete-btn:hover {
      color: #ef4444 !important;
      background: #fee2e2 !important;
    }
    #searchModal .history-delete-btn .material-symbols-outlined {
      font-size: 15px !important;
    }

    #searchModal .btn-clear-history {
      background: transparent !important;
      border: none !important;
      color: #94a3b8 !important;
      font-size: 12px !important;
      font-weight: 500 !important;
      cursor: pointer !important;
      padding: 3px 6px !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 3px !important;
      transition: color 0.2s ease !important;
      border-radius: 4px !important;
    }
    #searchModal .btn-clear-history:hover {
      color: #ef4444 !important;
      background: #fee2e2 !important;
    }
    #searchModal .btn-clear-history .material-symbols-outlined {
      font-size: 14px !important;
    }

    /* No Results State in Dropdown */
    #searchModal .dropdown-no-results {
      padding: 32px 20px !important;
      text-align: center !important;
    }
    #searchModal .no-results-icon-wrap {
      width: 48px !important;
      height: 48px !important;
      border-radius: 50% !important;
      background: #fef3c7 !important;
      color: #d97706 !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      margin-bottom: 10px !important;
    }
    #searchModal .no-results-icon-wrap .material-symbols-outlined {
      font-size: 24px !important;
    }
    #searchModal .no-results-text {
      font-size: 14.5px !important;
      font-weight: 600 !important;
      color: #1e293b !important;
      margin-bottom: 2px !important;
    }
    #searchModal .no-results-subtext {
      font-size: 13px !important;
      color: #64748b !important;
      margin-bottom: 0 !important;
    }

    /* Custom Scrollbar */
    #searchModal .searchable-dropdown-menu::-webkit-scrollbar {
      width: 6px !important;
    }
    #searchModal .searchable-dropdown-menu::-webkit-scrollbar-track {
      background: transparent !important;
    }
    #searchModal .searchable-dropdown-menu::-webkit-scrollbar-thumb {
      background: #e2e8f0 !important;
      border-radius: 10px !important;
    }
    #searchModal .searchable-dropdown-menu::-webkit-scrollbar-thumb:hover {
      background: #cbd5e1 !important;
    }
  </style>

  <div class="modal genericmodal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <form class="allForm m-0" wire:submit.prevent>
            <!-- Searchable Input Bar -->
            <div class="searchable-input-wrapper">
              <span class="material-symbols-outlined search-main-icon">search</span>
              <input name="search" type="text" class="searchcontent" id="mainSearchInput"
                placeholder="Search medicine by name or category..."
                wire:model.live.debounce.250ms="search_products"
                autocomplete="off">

              @if (!empty($search_products))
                <button type="button" class="clear-search-btn" wire:click="clearSearch" title="Clear input">
                  <span class="material-symbols-outlined" style="font-size: 15px;">close</span>
                </button>
              @endif

              <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close" title="Close">
                <span class="material-symbols-outlined">close</span>
              </button>
            </div>

            <!-- Searchable Dropdown Menu -->
            <div class="searchable-dropdown-menu">
              <!-- When Search Query is Active -->
              @if (!empty($search_products))
                @if ($variants->isNotEmpty())
                  <div class="dropdown-section-header">
                    <span class="header-label">
                      <span class="material-symbols-outlined">medication</span>
                      <span>Medicines Found ({{ $variants->count() }})</span>
                    </span>
                    <span class="text-muted" style="font-size: 11px; text-transform: none;">Click to view details</span>
                  </div>
                  <ul class="searchable-dropdown-list">
                    @foreach ($variants as $variant)
                      <li class="searchable-dropdown-item">
                        <!-- Clickable Dropdown Link wrapping Medicine Image, Name, and Category -->
                        <a href="{{ $this->generateSearchUrl($variant) }}" class="searchable-dropdown-link"
                          onclick="saveMedicineToLocal({ sku: '{{ addslashes($variant->sku) }}', name: '{{ addslashes($variant->name ?? $variant->product_name) }}', category: '{{ addslashes($variant->category_name) }}', url: '{{ addslashes($variant->url ?? $this->generateSearchUrl($variant)) }}' });">
                          <!-- Medicine Image Thumbnail -->
                          <figure class="searchable-med-image mb-0">
                            <img src="{{ get_default_variant_image($variant) }}"
                              alt="{{ $variant->name ?? 'Medicine Image' }}"
                              title="{{ $variant->name ?? 'Medicine' }}"
                              onerror="this.src='{{ asset('public/frontend/assets/img/home/search.png') }}'" />
                          </figure>

                          <!-- Medicine Name and Category -->
                          <div class="searchable-med-info">
                            <h5 class="searchable-med-name mb-1">
                              {{ $variant->name ?? $variant->product_name }}
                            </h5>
                            <div class="searchable-med-meta">
                              <span class="searchable-category-badge">
                                <span class="material-symbols-outlined">category</span>
                                {{ $variant->category_name }}
                              </span>
                              @if (!empty($variant->sale_price))
                                <span class="searchable-price-badge">₹{{ number_format($variant->sale_price, 2) }}</span>
                              @endif
                            </div>
                          </div>

                          <!-- Navigation Arrow -->
                          <span class="material-symbols-outlined dropdown-item-arrow">arrow_forward</span>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @else
                  <!-- No Results Dropdown State -->
                  <div class="dropdown-no-results">
                    <div class="no-results-icon-wrap">
                      <span class="material-symbols-outlined">search_off</span>
                    </div>
                    <h6 class="no-results-text">No medicines found</h6>
                    <p class="no-results-subtext">No matches found for "<strong>{{ $search_products }}</strong>".</p>
                  </div>
                @endif

              <!-- When Input is Empty: Show Recent Search History Dropdown -->
              @elseif (!empty($searchHistory) && count($searchHistory) > 0)
                <div class="dropdown-section-header">
                  <span class="header-label">
                    <span class="material-symbols-outlined">history</span>
                    <span>Recent Searches</span>
                  </span>
                  <button type="button" class="btn-clear-history" wire:click="clearSearchHistory" title="Clear all history">
                    <span class="material-symbols-outlined">delete_sweep</span>
                    <span>Clear History</span>
                  </button>
                </div>
                <div class="history-dropdown-list">
                  @foreach ($searchHistory as $item)
                    <div class="history-dropdown-item">
                      <!-- Clickable area => goes to details page -->
                      <a href="{{ $item['url'] ?? (!empty($item['sku']) ? route('product.show', ['variant' => $item['sku']]) : '#') }}"
                        class="history-dropdown-link flex-grow-1 d-flex align-items-center justify-content-between"
                        onclick="saveMedicineToLocal({ sku: '{{ addslashes($item['sku'] ?? '') }}', name: '{{ addslashes($item['name'] ?? '') }}', category: '{{ addslashes($item['category'] ?? '') }}', url: '{{ addslashes($item['url'] ?? '') }}' });">
                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                          <span class="material-symbols-outlined text-warning" style="font-size: 17px;">history</span>
                          <span class="history-med-name">{{ $item['name'] }}</span>
                        </div>
                        <span class="searchable-category-badge flex-shrink-0 ms-2">
                          <span class="material-symbols-outlined">category</span>
                          {{ $item['category'] ?? 'General Medicine' }}
                        </span>
                      </a>
                      <!-- Delete single item from history -->
                      <button type="button" class="history-delete-btn ms-2"
                        wire:click.stop="removeSearchHistory('{{ addslashes($item['sku'] ?: $item['name']) }}')"
                        title="Remove from history">
                        <span class="material-symbols-outlined">close</span>
                      </button>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('component-scripts')
  <script>
    const LOCAL_MED_HISTORY_KEY = 'fortier_medicine_search_history_items';

    function getLocalMedicineHistory() {
      try {
        const stored = localStorage.getItem(LOCAL_MED_HISTORY_KEY);
        return stored ? JSON.parse(stored) : [];
      } catch (e) {
        return [];
      }
    }

    function saveMedicineToLocal(item) {
      if (!item || !item.name) return;
      try {
        let history = getLocalMedicineHistory();
        const itemSku = (item.sku || '').toLowerCase().trim();
        const itemName = (item.name || '').toLowerCase().trim();
        history = history.filter(h => {
          const hSku = (h.sku || '').toLowerCase().trim();
          const hName = (h.name || '').toLowerCase().trim();
          return (itemSku ? hSku !== itemSku : true) && hName !== itemName;
        });
        history.unshift({
          sku: item.sku || '',
          name: item.name || '',
          category: item.category || 'General Medicine',
          url: item.url || ''
        });
        if (history.length > 8) history = history.slice(0, 8);
        localStorage.setItem(LOCAL_MED_HISTORY_KEY, JSON.stringify(history));
      } catch (e) {}
    }

    function removeMedicineFromLocal(identifier) {
      try {
        const id = (identifier || '').toLowerCase().trim();
        let history = getLocalMedicineHistory();
        history = history.filter(h => {
          const hSku = (h.sku || '').toLowerCase().trim();
          const hName = (h.name || '').toLowerCase().trim();
          return hSku !== id && hName !== id;
        });
        localStorage.setItem(LOCAL_MED_HISTORY_KEY, JSON.stringify(history));
      } catch (e) {}
    }

    function clearLocalMedicineHistory() {
      try {
        localStorage.removeItem(LOCAL_MED_HISTORY_KEY);
      } catch (e) {}
    }

    document.addEventListener('livewire:initialized', () => {
      const searchModal = document.getElementById('searchModal');
      const searchInput = searchModal ? searchModal.querySelector('.searchcontent') : null;

      // Sync local history with Livewire on load
      const localHistory = getLocalMedicineHistory();
      if (localHistory && localHistory.length > 0) {
        Livewire.dispatch('sync-local-medicine-history', { localHistory: localHistory });
      }

      if (searchModal) {
        searchModal.addEventListener('shown.bs.modal', () => {
          if (searchInput) searchInput.focus();
        });

        searchModal.addEventListener('hidden.bs.modal', () => {
          Livewire.dispatch('clearSearch');
        });
      }

      if (searchInput) {
        searchInput.addEventListener('keydown', (event) => {
          if (event.key === 'Enter') {
            event.preventDefault();
            const firstResult = searchModal.querySelector('.searchable-dropdown-item a.searchable-dropdown-link');
            if (firstResult && firstResult.href) {
              firstResult.click();
            }
          }
        });
      }

      // Listen for Livewire events
      Livewire.on('save-local-medicine-history', (event) => {
        const item = event.item || (Array.isArray(event) && event[0] ? event[0].item : null);
        if (item) saveMedicineToLocal(item);
      });

      Livewire.on('remove-local-medicine-history', (event) => {
        const identifier = event.identifier || (Array.isArray(event) && event[0] ? event[0].identifier : null);
        if (identifier) removeMedicineFromLocal(identifier);
      });

      Livewire.on('clear-local-medicine-history', () => {
        clearLocalMedicineHistory();
      });
    });
  </script>
@endpush
