<div>
    <div class="">
        @if ($message = Session::get('message'))
            <div class="alert alert-success alert-block mt-2 d-flex justify-content-between">
                <div class="mt-1">
                    <strong>{{ $message }}</strong>
                </div>

                <div class="btn close ms-auto" data-dismiss="alert">x</div>
            </div>
        @endif
        <div class="row mx-auto mt-5 mb-3 d-flex justify-content-between">
            <div class="col-md-3 text-white mb-5 mt-4">
                <div class="card" style="height: 550px; background-color:rgb(199, 10, 216)">
                    <div class="mt-4 mx-4">
                        <input type="search" wire:model="search" class="form-control input" placeholder="Search">
                    </div>
                    <div class="mx-4">
                        <label>Genre</label>
                        <div class="form-check">
                            <input wire:model='byRock' name="Rock" class="form-check-input" type="checkbox" value="Rock"
                                id="Rock">
                            <label class="form-check-label" for="Rock">
                                Rock
                            </label>
                        </div>
                        <div class="form-check">
                            <input wire:model='byPop' name="Rock" class="form-check-input" type="checkbox" value="Pop"
                                id="Pop">
                            <label class="form-check-label" for="Pop">
                                Pop
                            </label>
                        </div>
                        <div class="form-check">
                            <input wire:model='byReggae' class="form-check-input" type="checkbox" value="Reggae"
                                id="Reggae">
                            <label class="form-check-label" for="Reggae">
                                Reggae
                            </label>
                        </div>
                        <div class="form-check">
                            <input wire:model='byAcoustic' class="form-check-input" type="checkbox" value="Acoustic"
                                id="Acoustic">
                            <label class="form-check-label" for="Acoustic">
                                Acoustic
                            </label>
                        </div>
                        <div class="form-check">
                            <input wire:model='byClassical' class="form-check-input" type="checkbox" value="Classical"
                                id="Classical">
                            <label class="form-check-label" for="Classical">
                                Classical
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="ms-3" style="width: 250px;">
                        <label>Location</label>
                        <select class="form-select" wire:model="byLocation">
                            <option value="all">Select Location</option>
                            @foreach ($bands as $band)
                                <option value="{{ $band->location }}">{{ $band->location }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="ms-3">
                        <label for="customRange2">Rate</label><br>
                        <input type="range" class="form-range" min="100" max="10000" id="customRange2"
                            style="width: 250px;" wire:model='byRate'>
                        <p>P{{ $this->byRate }}</p>
                    </div>
                    <div class="ms-3" style="width: 250px;">
                        <label for="">Sort by</label>
                        <select name="" id="" class="form-control" wire:model='srtBy'>
                            <option value="asc">Lowest to Highest</option>
                            <option value="desc">Highest to Lowest</option>
                        </select>
                    </div>
                    <button class="btn btn-primary col-md-6 mt-2 ms-auto me-3" wire:click='resetFilters' type='button'>
                        Reset
                    </button>

                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-between mx-auto">
                    <button type="button" class="btn me-5 mb-3 bg-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Add Band
                    </button>
                    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-center">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Band Profile</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form wire:submit.prevent="addProfile()">
                                        @csrf
                                        <div class="container mx-auto">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="" style="color:dimgray">Image:</label>
                                                        <input type="file" wire:model="image"
                                                            class="form-control">
                                                        @if ($image)
                                                            Photo Preview:
                                                            <img src="{{ $image->temporaryUrl() }}"
                                                                style="width:100px; height:100px">
                                                        @endif

                                                        @error('image')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" style="color:dimgray">Band Name:</label>
                                                        <input type="text" class="form-control"
                                                            wire:model="bandName">
                                                        @error('name')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="" style="color:dimgray">Location</label>
                                                        <input type="text" class="form-control"
                                                            wire:model="location">
                                                        @error('location')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" style="color:dimgray">Rate</label>
                                                        <input type="number" class="form-control" wire:model="rate">
                                                        @error('rate')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="">
                                                        <label for="genre" style="color:dimgray">Genre</label>
                                                        <select class="form-select" wire:model="genre"
                                                            id="genre">
                                                            <option selected>Select Genre</option>
                                                            <option value="Pop">Pop</option>
                                                            <option value="Rock">Rock</option>
                                                            <option value="Reggae">Reggae</option>
                                                            <option value="Acoustic">Acoustic</option>
                                                            <option value="Classical">Classical</option>
                                                        </select>
                                                        @error('genre')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for=""
                                                            style="color:dimgray">Description</label>
                                                        <textarea type="number" class="form-control" wire:model="description"></textarea>
                                                        @error('description')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Band</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($bands as $band)
                        <div data-bs-toggle="modal" data-bs-target="#viewBand{{ $band->id }}"
                            class="card mb-3 btnh me-3 shadow-lg" style="max-width: 380px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage') }}/{{ $band->image }}"
                                        class="img-fluid mt-2 mb-2" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $band->bandName }}</h6>
                                        <label class="card-text"><span class="fst-italic">Location: </span> <span
                                                class="fw-semibold"> {{ $band->location }} </span></label>
                                        <label class="card-text"><span class="fst-italic">Rate: </span> <span
                                                class="fw-semibold">P{{ $band->rate }} </span></label><br>
                                        <label class="card-text"><span class="fst-italic">Genre: </span> <span
                                                class="fw-semibold"> {{ $band->genre }} </span></label>

                                    </div>
                                    <div class="col-md-2 ms-auto">
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#updateBand{{ $band->id }}">
                                            <svg wire:click="editProfile({{ $band->id }})"
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square mb-2"
                                                viewBox="0 0 16 16" style="color:rgb(117, 115, 236)">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $band->id }}">
                                            <svg wire:click="deleteProfile({{ $band->id }})"
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3-fill mb-2"
                                                viewBox="0 0 16 16" style="color:rgb(150, 109, 109)">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div wire:ignore.self class="modal fade" id="updateBand{{ $band->id }}" tabindex="-1"
                            aria-labelledby="updateBandLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-center">
                                        <h1 class="modal-title fs-5" id="updateBandLabel">Edit Band Profile </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form wire:submit.prevent="updateProfile()">
                                            @csrf
                                            <div class="container mx-auto">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="" style="color:dimgray">Image:</label>
                                                            <input type="file" wire:model="image"
                                                                class="form-control">
                                                            {{-- <img src="{{asset('storage')}}/{{$this->image}}" class="img-fluid mt-2 mb-2" alt="..."> --}}
                                                            @if ($image)
                                                                Photo Preview:
                                                                <img src="{{ $image->temporaryUrl() }}"
                                                                    style="width:100px; height:100px">
                                                            @endif

                                                            @error('image')
                                                                <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="" style="color:dimgray">Band
                                                                Name:</label>
                                                            <input type="text" class="form-control"
                                                                wire:model="bandName">
                                                            @error('name')
                                                                <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for=""
                                                                style="color:dimgray">Location</label>
                                                            <input type="text" class="form-control"
                                                                wire:model="location">
                                                            @error('location')
                                                                <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" style="color:dimgray">Rate</label>
                                                            <input type="number" class="form-control"
                                                                wire:model="rate">
                                                            @error('rate')
                                                                <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="">
                                                            <label for="genre" style="color:dimgray">Genre</label>
                                                            <select class="form-select" wire:model="genre"
                                                                id="genre">
                                                                <option selected>Select Genre</option>
                                                                <option value="Pop">Pop</option>
                                                                <option value="Rock">Rock</option>
                                                                <option value="Reggae">Reggae</option>
                                                                <option value="Acoustic">Acoustic</option>
                                                                <option value="Classical">Classical</option>
                                                            </select>
                                                            @error('genre')
                                                                <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for=""
                                                                style="color:dimgray">Description</label>
                                                            <textarea type="number" class="form-control" wire:model="description"></textarea>
                                                            @error('description')
                                                                <span class="error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Band</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore.self class="modal fade" id="deleteModal{{ $band->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h1 class="modal-title fs-5" id="deleteModalLabel">Delete</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button wire:click="destroyProfile" class="btn btn-primary">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore.self class="modal fade" id="viewBand{{ $band->id }}" tabindex="-1"
                            aria-labelledby="viewBandLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="color:rgb(88, 164, 247)">
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('storage') }}/{{ $band->image }}"
                                                class="rounded-circle w-25" alt="...">
                                        </div>
                                        <h3 class="text-center">{{ $band->bandName }}</h3>
                                        <hr>
                                        <p class="text-center">{{ $band->description }}</p>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-primary rounded-pill">Book Now</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            {{ $bands->links() }}
        </div>
    </div>
</div>
