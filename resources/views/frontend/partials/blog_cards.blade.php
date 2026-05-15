@foreach($blogs as $blog)
    <article class="card reveal" data-category="{{ $blog->category_rel->slug ?? 'uncategorized' }}">
    <div class="card-img">
        @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
        @else
        <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?auto=format&fit=crop&q=80&w=700"
            alt="{{ $blog->title }}">
        @endif
    </div>
    <div class="card-body" style="display: flex; flex-direction: column; height: 100%;">
        <div>
            <span class="card-tag" style="color:var(--crimson);">{{ strtoupper($blog->category_rel->name ?? 'UNCATEGORIZED') }}</span>
            <h3 class="card-title">{{ $blog->title }}</h3>
            <p style="color:var(--slate); font-size:0.9rem; margin-bottom:1rem; line-height:1.6;">{{ Str::limit($blog->excerpt, 120) }}</p>
        </div>
        
        <div style="margin-top: auto;">
            <div class="card-hashtags">
            @if($blog->tags)
                @foreach(explode(',', $blog->tags) as $tag)
                <span>{{ trim($tag) }}</span>
                @endforeach
            @endif
            </div>
            <div class="card-meta"
            style="justify-content:space-between; border-top:1px solid rgba(184,36,48,0.1); padding-top:1.2rem; margin-top:1rem;">
            <span class="card-meta-item">{{ $blog->created_at->format('M d, Y') }}</span>
            <a href="{{ route('frontend.blogDetails', $blog->slug) }}"
                style="text-decoration:none; color:var(--blue); font-weight:600; font-size:0.85rem; display:flex; align-items:center; gap:0.4rem;">Read
                Article &rarr;</a>
            </div>
        </div>
    </div>
    </article>
@endforeach
