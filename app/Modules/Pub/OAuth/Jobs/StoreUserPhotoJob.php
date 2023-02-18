<?php

namespace App\Modules\Pub\OAuth\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class StoreUserPhotoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ?string $path;
    private ?User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $path, User $user)
    {
        $this->path = $path;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $contents = Http::get($this->path)->body();
        $fileInfo = pathinfo($this->path);
        $filename = md5($this->user->id).'.'.$fileInfo['extension'];

        Storage::disk('public')->put('/users/photos/'.$filename, $contents);
        $this->user->photo = '/storage/users/photos/'.$filename;
        $this->user->save();

    }
}
