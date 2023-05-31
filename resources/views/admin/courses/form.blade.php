
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>English Title</label>
            <input type="text" class="form-control @error('title_en') is-invalid @enderror" placeholder="English Title" value="{{ old('title_en', $course->title_en) }}" name="title_en">
            <small class="form-text">To get any Icon Visit <a target="_blank" href="https://fontawesome.com/search?q=&o=r&m=free">FontAwesome</a> Icons</small>
            @error('title_en')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Arabic Title</label>
            <input type="text" class="form-control @error('title_ar') is-invalid @enderror" placeholder="Arabic Title" value="{{ old('title_ar', $course->title_ar) }}" name="title_ar">
            <small class="form-text">To get any Icon Visit <a target="_blank" href="https://fontawesome.com/search?q=&o=r&m=free">FontAwesome</a> Icons</small>
            @error('title_ar')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
    <img src="{{ asset('uploads/'.$course->image) }}" width="80" alt="">
    @error('image')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label>Content</label>
    <textarea class="custom-editor form-control @error('content') is-invalid @enderror" placeholder="Content" name="content">{{ old('content', $course->content) }}</textarea>
    @error('content')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>Price</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Price" value="{{ old('price', $course->price) }}" name="price">
            @error('price')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Duration</label>
            <input type="text" class="form-control @error('duration') is-invalid @enderror" placeholder="Duration" value="{{ old('duration', $course->duration) }}" name="duration">
            @error('duration')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Category</label>
            <select class="form-control @error('category_id') is-invalid @enderror" value="{{ old('category_id') }}" name="category_id">
                @foreach ($categories as $category)
                    <option @selected($course->category_id == $category->id) value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Instructor</label>
            <select class="form-control @error('instructor_id') is-invalid @enderror" value="{{ old('instructor_id') }}" name="instructor_id">
                @foreach ($instructors as $instructor)
                    <option @selected($course->instructor_id == $instructor->id) value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                @endforeach
            </select>
            @error('instructor_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
