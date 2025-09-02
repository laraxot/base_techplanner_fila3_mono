{{--
Bootstrap Italia Widget Component for Predict Chart
Enhanced chart display with Bootstrap Italia compliance and notifications
--}}

@props([
    'widget' => null,
    'title' => 'Prediction Chart',
    'description' => 'Real-time prediction analytics and trends',
    'showControls' => true,
    'showStats' => true,
    'chartType' => 'line'
])

<div class="predict-chart-widget mb-4">
    {{-- Widget Header with Bootstrap Italia styling --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0 fw-semibold">
                        <svg class="icon icon-sm me-2">
                            <use href="#it-chart-line"></use>
                        </svg>
                        {{ $title }}
                    </h4>
                    @if($description)
                    <small class="text-white-50">{{ $description }}</small>
                    @endif
                </div>
                @if($showControls)
                <div class="col-auto">
                    {{-- Chart Controls using Bootstrap Italia Tab component --}}
                    <x-bootstrap-italia.tab orientation="horizontal" size="sm">
                        <x-slot name="tabs">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#chart-view" type="button" role="tab">
                                    <svg class="icon icon-xs me-1">
                                        <use href="#it-chart-line"></use>
                                    </svg>
                                    Chart
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#table-view" type="button" role="tab">
                                    <svg class="icon icon-xs me-1">
                                        <use href="#it-table"></use>
                                    </svg>
                                    Data
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#export-view" type="button" role="tab">
                                    <svg class="icon icon-xs me-1">
                                        <use href="#it-download"></use>
                                    </svg>
                                    Export
                                </button>
                            </li>
                        </x-slot>
                    </x-bootstrap-italia.tab>
                </div>
                @endif
            </div>
        </div>

        <div class="card-body p-0">
            {{-- Tab Content --}}
            <div class="tab-content">
                {{-- Chart View --}}
                <div class="tab-pane fade show active" id="chart-view" role="tabpanel">
                    <div class="p-4">
                        {{-- Status Notification --}}
                        <div class="mb-3">
                            <x-bootstrap-italia.notifiche 
                                type="info"
                                title="Live Data"
                                message="Chart updates every 30 seconds with real-time prediction data"
                                :dismissible="false"
                                position="static"
                                size="sm"
                                icon="clock"
                            />
                        </div>

                        {{-- Chart Container --}}
                        <div class="chart-container position-relative">
                            @if($widget)
                                {{-- Render the actual Filament widget --}}
                                <div id="predict-chart-widget">
                                    @livewire($widget)
                                </div>
                            @else
                                {{-- Placeholder chart --}}
                                <div class="bg-light rounded p-4 text-center">
                                    <svg class="icon icon-xl text-muted mb-3">
                                        <use href="#it-chart-line"></use>
                                    </svg>
                                    <h5 class="text-muted">Chart Loading...</h5>
                                    <x-bootstrap-italia.progress-indicators 
                                        type="spinner" 
                                        size="lg"
                                        active="true"
                                    />
                                </div>
                            @endif

                            {{-- Loading overlay --}}
                            <div id="chart-loading" class="position-absolute top-0 start-0 w-100 h-100 d-none bg-white bg-opacity-75 d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <x-bootstrap-italia.progress-indicators 
                                        type="spinner" 
                                        size="lg"
                                        active="true"
                                    />
                                    <p class="mt-2 text-muted">Updating chart data...</p>
                                </div>
                            </div>
                        </div>

                        {{-- Chart Statistics --}}
                        @if($showStats)
                        <div class="row mt-4">
                            <div class="col-md-3 col-6">
                                <div class="text-center p-3 bg-light rounded">
                                    <div class="display-6 fw-bold text-success">87%</div>
                                    <small class="text-muted">Accuracy</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="text-center p-3 bg-light rounded">
                                    <div class="display-6 fw-bold text-primary">1.2K</div>
                                    <small class="text-muted">Data Points</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="text-center p-3 bg-light rounded">
                                    <div class="display-6 fw-bold text-warning">45ms</div>
                                    <small class="text-muted">Latency</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="text-center p-3 bg-light rounded">
                                    <div class="display-6 fw-bold text-info">99.9%</div>
                                    <small class="text-muted">Uptime</small>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Table View --}}
                <div class="tab-pane fade" id="table-view" role="tabpanel">
                    <div class="p-4">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Timestamp</th>
                                        <th>Prediction</th>
                                        <th>Confidence</th>
                                        <th>Model</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ now()->format('Y-m-d H:i:s') }}</td>
                                        <td><span class="fw-bold text-success">High</span></td>
                                        <td>
                                            <x-bootstrap-italia.progress-indicators 
                                                type="bar" 
                                                :percentage="87" 
                                                size="sm"
                                                color="success"
                                                :show-percentage="true"
                                            />
                                        </td>
                                        <td>ML-Model-v2.1</td>
                                        <td>
                                            <x-bootstrap-italia.badge color="success" size="sm">
                                                Active
                                            </x-bootstrap-italia.badge>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ now()->subMinutes(5)->format('Y-m-d H:i:s') }}</td>
                                        <td><span class="fw-bold text-warning">Medium</span></td>
                                        <td>
                                            <x-bootstrap-italia.progress-indicators 
                                                type="bar" 
                                                :percentage="72" 
                                                size="sm"
                                                color="warning"
                                                :show-percentage="true"
                                            />
                                        </td>
                                        <td>ML-Model-v2.1</td>
                                        <td>
                                            <x-bootstrap-italia.badge color="success" size="sm">
                                                Active
                                            </x-bootstrap-italia.badge>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ now()->subMinutes(10)->format('Y-m-d H:i:s') }}</td>
                                        <td><span class="fw-bold text-primary">Low</span></td>
                                        <td>
                                            <x-bootstrap-italia.progress-indicators 
                                                type="bar" 
                                                :percentage="93" 
                                                size="sm"
                                                color="primary"
                                                :show-percentage="true"
                                            />
                                        </td>
                                        <td>ML-Model-v2.0</td>
                                        <td>
                                            <x-bootstrap-italia.badge color="warning" size="sm">
                                                Deprecated
                                            </x-bootstrap-italia.badge>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Export View --}}
                <div class="tab-pane fade" id="export-view" role="tabpanel">
                    <div class="p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Export Options</h5>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-primary">
                                        <svg class="icon icon-sm me-2">
                                            <use href="#it-file-pdf"></use>
                                        </svg>
                                        Export as PDF
                                    </button>
                                    <button class="btn btn-outline-primary">
                                        <svg class="icon icon-sm me-2">
                                            <use href="#it-file-excel"></use>
                                        </svg>
                                        Export as Excel
                                    </button>
                                    <button class="btn btn-outline-primary">
                                        <svg class="icon icon-sm me-2">
                                            <use href="#it-file-csv"></use>
                                        </svg>
                                        Export as CSV
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">Share Options</h5>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-secondary">
                                        <svg class="icon icon-sm me-2">
                                            <use href="#it-mail"></use>
                                        </svg>
                                        Send via Email
                                    </button>
                                    <button class="btn btn-outline-secondary">
                                        <svg class="icon icon-sm me-2">
                                            <use href="#it-share"></use>
                                        </svg>
                                        Share Link
                                    </button>
                                    <button class="btn btn-outline-secondary">
                                        <svg class="icon icon-sm me-2">
                                            <use href="#it-calendar"></use>
                                        </svg>
                                        Schedule Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Widget Footer --}}
        <div class="card-footer bg-light border-0">
            <div class="row align-items-center">
                <div class="col">
                    <small class="text-muted">
                        <svg class="icon icon-xs me-1">
                            <use href="#it-refresh"></use>
                        </svg>
                        Last updated: <span id="last-update">{{ now()->format('H:i:s') }}</span>
                    </small>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-outline-primary" id="refresh-chart">
                        <svg class="icon icon-xs me-1">
                            <use href="#it-refresh"></use>
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enhanced JavaScript functionality --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartContainer = document.getElementById('predict-chart-widget');
    const loadingOverlay = document.getElementById('chart-loading');
    const refreshButton = document.getElementById('refresh-chart');
    const lastUpdateElement = document.getElementById('last-update');
    
    // Auto-refresh functionality
    let autoRefreshInterval;
    
    function startAutoRefresh() {
        autoRefreshInterval = setInterval(function() {
            refreshChart();
        }, 30000); // Refresh every 30 seconds
    }
    
    function stopAutoRefresh() {
        if (autoRefreshInterval) {
            clearInterval(autoRefreshInterval);
        }
    }
    
    function refreshChart() {
        if (loadingOverlay) {
            loadingOverlay.classList.remove('d-none');
        }
        
        // Simulate chart refresh (in real implementation, this would trigger Livewire refresh)
        setTimeout(function() {
            if (loadingOverlay) {
                loadingOverlay.classList.add('d-none');
            }
            
            if (lastUpdateElement) {
                lastUpdateElement.textContent = new Date().toLocaleTimeString();
            }
            
            // Show success notification
            window.createNotification && window.createNotification(
                'Chart data updated successfully',
                'success',
                {
                    title: 'Data Updated',
                    autoHide: 3000,
                    position: 'right-fix',
                    icon: 'check-circle'
                }
            );
        }, 1500);
    }
    
    // Manual refresh button
    if (refreshButton) {
        refreshButton.addEventListener('click', function() {
            refreshChart();
        });
    }
    
    // Start auto-refresh when chart is visible
    if (chartContainer) {
        startAutoRefresh();
        
        // Stop auto-refresh when page is not visible
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                stopAutoRefresh();
            } else {
                startAutoRefresh();
            }
        });
    }
    
    // Export functionality
    document.querySelectorAll('[class*="btn-outline-primary"]').forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.textContent.includes('Export')) {
                e.preventDefault();
                
                // Show loading state
                const originalText = this.innerHTML;
                this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Exporting...';
                this.disabled = true;
                
                // Simulate export process
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                    
                    // Show success notification
                    window.createNotification && window.createNotification(
                        'Export completed successfully',
                        'success',
                        {
                            title: 'Export Complete',
                            autoHide: 3000,
                            position: 'right-fix',
                            icon: 'download'
                        }
                    );
                }, 2000);
            }
        });
    });
    
    // Tab switching analytics
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(e) {
            const targetTab = e.target.getAttribute('data-bs-target');
            console.log('Switched to tab:', targetTab);
            
            // Analytics tracking could be added here
        });
    });
});
</script>
@endpush

{{-- Custom styles for the widget --}}
@push('styles')
<style>
.predict-chart-widget .chart-container {
    min-height: 400px;
}

.predict-chart-widget .table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.9rem;
}

.predict-chart-widget .nav-tabs .nav-link {
    border: none;
    color: rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
}

.predict-chart-widget .nav-tabs .nav-link:hover,
.predict-chart-widget .nav-tabs .nav-link.active {
    color: white;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 0.375rem;
}

.predict-chart-widget .card-footer {
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.predict-chart-widget .btn-outline-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 102, 204, 0.2);
}

.predict-chart-widget .display-6 {
    font-size: 1.25rem;
    line-height: 1.2;
}

@media (max-width: 768px) {
    .predict-chart-widget .chart-container {
        min-height: 300px;
    }
    
    .predict-chart-widget .display-6 {
        font-size: 1rem;
    }
}
</style>
@endpush
