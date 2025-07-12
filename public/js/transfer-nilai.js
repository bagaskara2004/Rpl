// Transfer Nilai JavaScript Module
(function($) {
    'use strict';

    // Global variables
    let kurikulumSksMap = {};
    let allOptions = [];
    let transferNilaiInitialized = false;

    // Initialize the module
    function init(sksMapping) {
        kurikulumSksMap = sksMapping;
        
        // Add custom styles for Select2 search functionality
        addCustomStyles();
        
        // Prevent multiple initialization
        if (window.transferNilaiInitialized) {
            return;
        }
        window.transferNilaiInitialized = true;

        // Store all available options globally
        storeAllOptions();
        
        // Initialize Select2 elements
        initializeSelect2Elements();
        
        // Bind event handlers
        bindEventHandlers();
        
        // Initial setup
        setTimeout(function() {
            console.log('Initializing transfer nilai page...');
            console.log('kurikulumSksMap:', kurikulumSksMap);
            console.log('jQuery version:', $.fn.jquery);
            console.log('Select2 available:', typeof $.fn.select2 !== 'undefined');
            
            // Debug: Check if elements exist
            console.log('kurikulum-select elements found:', $('.kurikulum-select').length);
            console.log('totalSks element:', $('#totalSks').text());
            
            updateDropdownOptions();
            calculateSKS();
            
            // Force recalculation after a short delay
            setTimeout(function() {
                console.log('Force recalculation...');
                calculateSKS();
            }, 1000);
        }, 500);
    }

    // Add custom CSS styles
    function addCustomStyles() {
        $('<style>').text(`
            .btn-secondary {
                background-color: #ef4444 !important;
                color: white !important;
                border: none !important;
                cursor: pointer !important;
            }
            .btn-secondary:hover {
                background-color: #dc2626 !important;
                transform: translateY(-1px);
                box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);
            }
            .btn-primary {
                background-color: #2563eb !important;
                color: white !important;
                border: none !important;
                cursor: pointer !important;
            }
            .btn-primary:hover {
                background-color: #1d4ed8 !important;
                transform: translateY(-1px);
                box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
            }
            
            /* Enhanced Select2 styling */
            .select2-container {
                width: 100% !important;
            }
            
            .select2-container--default .select2-selection--single {
                height: 38px !important;
                border: 1px solid #d1d5db !important;
                border-radius: 6px !important;
                padding: 6px 12px !important;
            }
            
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 24px !important;
                padding-left: 0 !important;
            }
            
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 36px !important;
                right: 8px !important;
            }
            
            /* Force Select2 search to be visible and functional */
            .select2-container .select2-search--dropdown {
                display: block !important;
                padding: 8px !important;
                background: white !important;
            }
            
            .select2-container .select2-search--dropdown .select2-search__field {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                width: 100% !important;
                box-sizing: border-box !important;
                padding: 8px 12px !important;
                border: 1px solid #d1d5db !important;
                border-radius: 6px !important;
                font-size: 14px !important;
                background: white !important;
            }
            
            .select2-dropdown {
                border: 1px solid #d1d5db !important;
                border-radius: 6px !important;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
                z-index: 9999 !important;
            }
            
            .select2-results__option {
                padding: 8px 12px !important;
                font-size: 14px !important;
            }
            
            .select2-results__option--highlighted {
                background-color: #3b82f6 !important;
                color: white !important;
            }
            
            .select2-results__option--selected {
                background-color: #e5e7eb !important;
                color: #374151 !important;
            }
        `).appendTo('head');
    }

    // Store all available options globally
    function storeAllOptions() {
        allOptions = [];
        $('.kurikulum-select option').each(function() {
            if ($(this).val() !== '') {
                const kurikulumId = $(this).val();
                const sks = kurikulumSksMap[kurikulumId] || 0;
                allOptions.push({
                    id: kurikulumId,
                    text: $(this).text(),
                    sks: sks
                });
            }
        });
    }

    // Master Select2 configuration
    const select2Config = {
        placeholder: 'Pilih Mata Kuliah TRPL',
        allowClear: true,
        width: '100%',
        minimumInputLength: 0,
        minimumResultsForSearch: 0, // Always show search - this is critical!
        dropdownAutoWidth: false,
        language: {
            noResults: function() {
                return "Tidak ada hasil ditemukan";
            },
            searching: function() {
                return "Mencari...";
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        },
        templateResult: function(data) {
            if (data.loading) return data.text;
            return data.text;
        },
        templateSelection: function(data) {
            return data.text;
        }
    };

    // Function to safely initialize/reinitialize Select2
    function initializeSelect2Element($element) {
        try {
            // Destroy existing instance if exists
            if ($element.hasClass('select2-hidden-accessible')) {
                $element.select2('destroy');
            }

            // Initialize with our config
            $element.select2(select2Config);

            console.log('Select2 initialized for element:', $element.attr('name'));

        } catch (error) {
            console.log('Select2 initialization error:', error);
        }
    }

    // Initialize all Select2 elements
    function initializeSelect2Elements() {
        $('.kurikulum-select').each(function() {
            initializeSelect2Element($(this));
        });
    }

    // Function to update dropdown options and maintain Select2 functionality
    function updateDropdownOptions() {
        const selectedValues = [];

        // Collect all selected values
        $('.kurikulum-select').each(function() {
            const val = $(this).val();
            if (val) {
                selectedValues.push(val);
            }
        });

        // Update each dropdown
        $('.kurikulum-select').each(function() {
            const $currentSelect = $(this);
            const currentValue = $currentSelect.val();

            // Store reference to Select2 instance before destroying
            let wasOpen = false;
            if ($currentSelect.hasClass('select2-hidden-accessible')) {
                wasOpen = $currentSelect.data('select2')?.isOpen() || false;
                $currentSelect.select2('destroy');
            }

            // Rebuild options
            $currentSelect.empty();
            $currentSelect.append('<option value="">Pilih Mata Kuliah TRPL</option>');
            allOptions.forEach(function(option) {
                // Show option if not selected elsewhere, or if it's current selection
                if (!selectedValues.includes(option.id) || option.id === currentValue) {
                    $currentSelect.append('<option value="' + option.id + '" data-sks="' + option.sks + '">' + option.text + '</option>');
                }
            });

            // Restore current value
            $currentSelect.val(currentValue);

            // Reinitialize Select2
            initializeSelect2Element($currentSelect);

            // Reopen if it was open before
            if (wasOpen) {
                setTimeout(function() {
                    $currentSelect.select2('open');
                }, 100);
            }
        });
    }

    // Bind all event handlers
    function bindEventHandlers() {
        // Remove existing event handlers before adding new ones
        $(document).off('change', '.kurikulum-select');
        $(document).off('select2:open', '.kurikulum-select');
        $(document).off('select2:opening', '.kurikulum-select');
        $(document).off('select2:select', '.kurikulum-select');

        // Handle selection changes
        $(document).on('change', '.kurikulum-select', function() {
            const $this = $(this);
            console.log('Selection changed:', $this.val());
            console.log('Selected option data-sks:', $this.find('option:selected').data('sks'));

            // Immediate calculation
            calculateSKS();

            // Delay for dropdown update to avoid conflicts
            setTimeout(function() {
                updateDropdownOptions();
            }, 100);
        });

        // Additional event handler for Select2 specific events
        $(document).on('select2:select', '.kurikulum-select', function(e) {
            console.log('Select2 select event:', e.params.data);
            setTimeout(function() {
                calculateSKS();
                updateDropdownOptions();
            }, 50);
        });

        // Force search functionality on dropdown open
        $(document).on('select2:open', '.kurikulum-select', function(e) {
            console.log('Select2 dropdown opened');
            setTimeout(function() {
                const $searchField = $('.select2-search__field');
                if ($searchField.length > 0) {
                    $searchField.focus().attr('placeholder', 'Cari mata kuliah...');
                    console.log('Search field focused and placeholder set');
                } else {
                    console.log('Search field not found!');
                }
            }, 50);
        });

        // Search functionality for table
        $('#searchInput').off('keyup').on('keyup', function() {
            const searchValue = $(this).val().toLowerCase();
            let visibleRows = 0;

            $('.table-row').each(function() {
                const mataKuliah = $(this).find('td:nth-child(2) .font-semibold').text().toLowerCase();

                if (mataKuliah.includes(searchValue)) {
                    $(this).show();
                    visibleRows++;
                } else {
                    $(this).hide();
                }
            });

            // Update row numbers for visible rows
            updateRowNumbers();
        });

        // Handle Batal button clicks
        $(document).on('click', '#btnBatal, #btnBatalAjax', function(e) {
            e.preventDefault();

            if (confirm('Apakah Anda yakin ingin membatalkan perubahan? Semua data yang telah diisi akan hilang.')) {
                // Reset form
                $('form')[0].reset();

                // Reset all select2 dropdowns
                $('.kurikulum-select').val('').trigger('change');
                $('select[name="nilai_trpl[]"]').val('');
                $('input[name="keterangan[]"]').val('');

                // Update dropdown options and SKS calculation
                updateDropdownOptions();
                calculateSKS();

                // Clear search
                $('#searchInput').val('');
                $('.table-row').show();
                updateRowNumbers();

                // Show success message
                alert('Form telah direset.');
            }
        });
    }

    // Function to update row numbers
    function updateRowNumbers() {
        let counter = 1;
        $('.table-row:visible').each(function() {
            $(this).find('td:first-child .bg-gradient-to-r').text(counter);
            counter++;
        });
    }

    // SKS calculation functionality
    function calculateSKS() {
        let convertedSKS = 0;
        const totalSKS = parseInt($('#totalSks').text()) || 0;

        console.log('Calculating SKS... Total SKS:', totalSKS);
        console.log('kurikulumSksMap:', kurikulumSksMap);

        $('.kurikulum-select').each(function() {
            const selectedValue = $(this).val();
            console.log('Selected value:', selectedValue);

            if (selectedValue && kurikulumSksMap[selectedValue]) {
                const sks = parseInt(kurikulumSksMap[selectedValue]);
                console.log('Adding SKS:', sks);
                convertedSKS += sks;
            } else if (selectedValue) {
                // Fallback: get SKS from data attribute
                const sksFromAttr = parseInt($(this).find('option:selected').data('sks'));
                if (sksFromAttr && !isNaN(sksFromAttr)) {
                    console.log('Adding SKS from attr:', sksFromAttr);
                    convertedSKS += sksFromAttr;
                }
            }
        });

        console.log('Total converted SKS:', convertedSKS);

        $('#convertedSks').text(convertedSKS);

        // Update progress bar
        const percentage = totalSKS > 0 ? Math.round((convertedSKS / totalSKS) * 100) : 0;
        $('#progressPercent').text(percentage + '%');
        $('#progressBar').css('width', percentage + '%');

        console.log('Progress percentage:', percentage + '%');
    }

    // Expose public methods
    window.TransferNilai = {
        init: init,
        calculateSKS: calculateSKS,
        updateDropdownOptions: updateDropdownOptions
    };

})(jQuery);
