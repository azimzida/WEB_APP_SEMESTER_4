@extends('layouts.main')
@section('content')
@php
/* @var object $course */
/* @var array $categories */
function escape($v){ return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }
@endphp

<style>
    .form-card { background:#fff;border-radius:16px;padding:24px;border:1px solid #EEF2FF; box-shadow:0 20px 40px rgba(15,23,42,0.04); }
    .input { width:100%; padding:10px 12px; border-radius:10px; border:1px solid #E6E9F2; background:#FBFBFF; }
    .btn-save { background:#10B981; color:#fff; padding:10px 18px; border-radius:10px; font-weight:700; border:none; }
    .btn-cancel { background:#F3F4F6; padding:10px 18px; border-radius:10px; border:1px solid #E6E9F2; }
</style>

<div class="min-h-screen bg-slate-50 py-8">
    <div class="mx-auto max-w-4xl px-6">
        <h1 class="text-2xl font-bold mb-4">Edit Course</h1>

        <div class="form-card">
            <form action="/course/{{ $course->id }}/update" method="post">
                {{ csrf_field() }}

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2">Title</label>
                    <input name="title" class="input" value="{{ $course->nama_course ?? '' }}" required />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2">Category</label>
                    <select name="category" class="input">
                        <option value="">-- Select category --</option>
                        @if(isset($categories) && $categories)
@foreach($categories as $cat)
                            <option value="{{ $cat->kategori_id }}" {{ (!empty($course->kategori_id) && $course->kategori_id == $cat->kategori_id) ? 'selected' : '' }}>
                                {{ $cat->nama_kategori ?? $cat->name ?? '' }}
                            </option>
                        @endforeach
@endif
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2">Description</label>
                    <textarea name="description" rows="6" class="input">{{ $course->deskripsi ?? '' }}</textarea>
                </div>

                <div class="flex gap-3 justify-end">
                    <a href="/course/{{ $course->id }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection