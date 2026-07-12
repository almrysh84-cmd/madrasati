@if($announcements->isEmpty())
    <div class="alert alert-info text-center" style="font-family: Cairo">
        <i class="ti-info-alt"></i> {{ trans('Announcements_trans.no_announcements') }}
    </div>
@else
    <div class="announcements-list">
        @foreach($announcements as $announcement)
            <div class="card mb-3 border-{{ $announcement->target_audience_color }}">
                <div class="card-header bg-{{ $announcement->target_audience_color }} text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="ti-announcement"></i> {{ $announcement->title }}
                    </h6>
                    <span class="badge bg-light text-dark">
                        {{ $announcement->target_audience_text }}
                    </span>
                </div>
                <div class="card-body">
                    <p style="white-space: pre-wrap; font-family: Cairo">{{ $announcement->body }}</p>

                    @if($announcement->attachment)
                        <a href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank" class="btn btn-info btn-sm">
                            <i class="ti-download"></i> {{ trans('Announcements_trans.download_attachment') }}
                        </a>
                    @endif
                </div>
                <div class="card-footer text-muted">
                    <small>
                        <i class="ti-time"></i> {{ $announcement->publish_at ? $announcement->publish_at->format('Y-m-d H:i') : $announcement->created_at->format('Y-m-d H:i') }}
                        @if($announcement->creator)
                            | <i class="ti-user"></i> {{ $announcement->creator->name }}
                        @endif
                    </small>
                </div>
            </div>
        @endforeach
    </div>
@endif
