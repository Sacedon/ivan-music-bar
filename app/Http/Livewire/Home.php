<?php

namespace App\Http\Livewire;

use App\Models\Band;
use App\Models\Genre;
use Livewire\Component;
use Faker\Provider\Image;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class Home extends Component
{
    use WithFileUploads;
    public $search;
    public $byLocation = 'all';
    public $srtBy = "asc";
    public $byRate;
    public $byRock = '';
    public $byPop = '';
    public $byReggae = '';
    public $byAcoustic = '';
    public $byClassical = '';
    public $bandName, $location, $rate, $description, $image, $genre = [''];

    public function loadProfiles(){

        $query = Band::orderBy('rate', $this->srtBy)
            ->search($this->search);


        if($this->byRock == 'Rock' ){
            $query->where('genre',$this->byRock);
        }

        if($this->byPop == 'Pop' || $this->byReggae == 'Reggae' || $this->byRock == 'Rock' || $this->byAcoustic == 'Acoustic' ||$this->byClassical == 'Classical' ){
            $query->where('genre', $this->byPop)
                    ->orWhere('genre', $this->byReggae)
                    ->orWhere('genre', $this->byRock)
                    ->orWhere('genre', $this->byAcoustic)
                    ->orWhere('genre', $this->byClassical);
        }
        if($this->byReggae == 'Reggae' ){
            $query->where('genre', $this->byReggae);
        }
        if($this->byAcoustic == 'Acoustic' ){
            $query->where('genre', $this->byAcoustic);
        }
        if($this->byClassical == 'Classical' ){
            $query->where('genre', $this->byClassical);
        }


        if($this->byRate){
            $query->where('rate', '>=', $this->byRate);
        }

        if($this->byLocation != 'all'){
            $query->where('location', $this->byLocation);
        }
        $bands = $query->paginate(5);
        return compact('bands');
    }

    public function resetFilters(){
        $this->reset('search', 'byRock', 'byPop', 'byAcoustic', 'byReggae', 'byClassical', 'byRate', 'srtBy', 'byLocation');
    }
    public function addProfile(){

        $this->validate([
            'bandName' => ['string', 'required'],
            'description' => ['string', 'required'],
            'location' => ['string', 'required'],
            'genre' => ['required'],
            'rate' => ['string', 'required'],
            'image' => ['image', 'required'], // 1MB Max
        ]);

        Band::create([
            'bandName' => $this->bandName,
            'description' => $this->description,
            'location' => $this->location,
            'genre' => $this->genre,
            'rate' => $this->rate,
            'image' => $this->image->store('band-images', 'public')]);

            return redirect('/')->with('message', 'Created Successfully');

    }

    public function editProfile(int $band_id){
        $band = Band::find($band_id);
        if($band){
            $this->band_id = $band->id;
            $this->bandName = $band->bandName;
            $this->description = $band->description;
            $this->location = $band->location;
            $this->genre = $band->genre;
            $this->rate = $band->rate;


        }else{
            return redirect()->to('/');
        }

    }

    public function updateProfile(){
        $this->validate([
            'bandName' => ['string', 'required'],
            'description' => ['string', 'required'],
            'location' => ['string', 'required'],
            'genre' => ['required'],
            'rate' => ['string', 'required'],
            'image' => ['nullable'],

        ]);
        try{
        $band = Band::find($this->id);

        Band::where('id',$this->band_id)->update([
            'bandName' => $this->bandName,
            'description' => $this->description,
            'location' => $this->location,
            'genre' => $this->genre,
            'rate' => $this->rate,
        ]);

        if($this->image != null){
            Band::where('id',$this->band_id)->update(['image' => $this->image->store('band-images', 'public')]);
        }
        }catch(\Exception $e){
            return redirect('/')->with('message', 'Updated Successfully');
        }
        return redirect('/')->with('message', 'Updated Successfully');
    }

    public function deleteProfile(int $band_id)
    {
        $this->band_id = $band_id;
    }

    public function destroyProfile()
    {
        Band::find($this->band_id)->delete();
        return redirect('/')->with('message', 'Deleted Successfully');

    }

    public function render(){
        $bands = Band::where('bandName', 'like', '%'.$this->search.'%')
                    ->orWhere('location', 'like', '%'.$this->search.'%')
                    ->orWhere('rate', 'like', '%'.$this->search.'%')
                    ->orWhere('genre', 'like', '%'.$this->search.'%')
                    ->get();
        return view('livewire.home', $this->loadProfiles(), ['bands' => $bands] );
    }
}
