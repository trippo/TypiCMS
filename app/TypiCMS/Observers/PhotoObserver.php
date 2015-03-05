<?php
namespace TypiCMS\Observers;

use Croppa;
use File;
use FileUpload;
use Illuminate\Database\Eloquent\Model;
use Input;

class PhotoObserver
{

    /**
     * On delete, unlink photos and thumbs
     * @param  Model $model eloquent
     * @return mixed false or void
     */
    public function deleted(Model $model)
    {
        if (! $attachments = $model->attachments) {
            return;
        }

        foreach ($attachments as $fieldname) {
            $photo = '/uploads/' . $model->getTable() . '/' . $model->getOriginal($fieldname);
            $this->delete($photo);
        }
    }

    /**
     * Delete photo and thumbs
     * 
     * @param  string $photo
     * @return void
     */
    public function delete($photo)
    {
        Croppa::delete($photo);
        File::delete(public_path() . $photo);
    }

    /**
     * On save, upload photos
     * 
     * @param  Model $model eloquent
     * @return mixed false or void
     */
    public function saving(Model $model)
    {

        if (! $attachments = $model->attachments) {
            return;
        }

        foreach ($attachments as $fieldname) {
            if (Input::hasFile($fieldname)) {
                // delete prev image
                $photo = FileUpload::handle(Input::file($fieldname), 'uploads/' . $model->getTable());
                $model->$fieldname = $photo['filename'];
                if ($model->getTable() == 'photos') {
                    $model->fill($photo);
                }
            } else {
                if ($model->$fieldname == 'delete') {
                    $model->$fieldname = null;
                } else {
                    $model->$fieldname = $model->getOriginal($fieldname);
                }
            }
        }
    }

    /**
     * On update, delete previous photo if changed
     * 
     * @param  Model $model eloquent
     * @return mixed false or void
     */
    public function updated(Model $model)
    {
        if (! $attachments = $model->attachments) {
            return;
        }

        foreach ($attachments as $fieldname) {

            // Nothing to do if photo did not change
            if (! $model->isDirty($fieldname)) {
                continue;
            }

            $photo = '/uploads/' . $model->getTable() . '/' . $model->getOriginal($fieldname);
            $this->delete($photo);

        }
    }
}
