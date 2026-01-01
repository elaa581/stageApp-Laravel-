@extends('layouts.app')

@section('title', 'CVs libres')

@section('styles')
<style>
.cv-card {
    max-width: 500px;
    margin: auto;
    border-radius: 10px;
    overflow: hidden;
}

.cv-image {
    width: 100%;
    height: 380px;
    object-fit: cover;
}

.like-btn {
    cursor: pointer;
    font-size: 20px;
}
.liked {
    color: red;
}
</style>
@endsection

@section('content')
<div class="container mt-4">
    <h3 class="text-center mb-4">📂 CVs disponibles</h3>

    @forelse($candidatures as $c)
        <div class="card cv-card mb-5 shadow">

            {{-- Header --}}
            <div class="card-header bg-white">
                <strong>{{ $c->etudiant->user->name }}</strong>
                <span class="text-muted float-end">
                    {{ $c->created_at->diffForHumans() }}
                </span>
            </div>

            {{-- Image / CV Preview --}}
            <div>
                @if(Str::endsWith($c->cv, ['jpg','jpeg','png']))
                    <img src="{{ asset('storage/'.$c->cv) }}"
                         class="cv-image">
                @else
                    <div class="p-5 text-center bg-light">
                        <i class="bi bi-file-earmark-pdf" style="font-size:80px;"></i>
                        <p class="mt-3">Document CV</p>
                    </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="card-body">
                <span class="like-btn" onclick="like(this)">
                    ❤️ J'aime
                </span>

                <p class="mt-3">
                    {{ $c->description ?? 'Aucune description' }}
                </p>

                <a href="{{ asset('storage/'.$c->cv) }}"
                   target="_blank"
                   class="btn btn-outline-primary w-100">
                    📥 Télécharger le CV
                </a>
            </div>

        </div>
    @empty
        <p class="text-center text-muted">
            Aucun CV disponible pour le moment.
        </p>
    @endforelse
</div>
@endsection

@section('scripts')
<script>
function like(el) {
    el.classList.toggle('liked');
    el.innerText = el.classList.contains('liked') ? '❤️ Aimé' : '❤️ J\'aime';
}
</script>
@endsection

