<?php

class ExperienceController extends BaseController 
{

    public function save()
    {
        if (isset($_POST)) {
            $data = [
                'exeriencepImage' => $_FILES['exeriencepImage'],
                'raceName' => $_POST['raceName'],
                'raceStartDate' => $_POST['raceStartDate'],
                'raceEndDate' => $_POST['raceEndDate'],
                'raceRank' => $_POST['raceRank'],
                'raceInfo' => $_POST['raceInfo'],
            ];

            $ExperiencePhoto = '';
            if ($data['exeriencepImage']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (in_array($data['exeriencepImage']['type'], $allowedTypes)) {
                    $uploadDir = IMAGESROOT . 'photos/';
                    
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
        
                    $ExperiencePhoto = time() . '_' . basename($data['exeriencepImage']['name']);
                    $ExperiencePath = $uploadDir . $ExperiencePhoto;
        
                    if (!move_uploaded_file($data['exeriencepImage']['tmp_name'], $ExperiencePath)) {
                        $errors['thumbnail_err'] = 'Failed to upload the thumbnail.';
                    }
                } else {
                    $errors['thumbnail_err'] = 'Invalid image format. Allowed formats are JPG, PNG, and GIF.';
                }

            }
            $Experience = new Experience(null, $ExperiencePhoto, $data['raceName'], $data['raceStartDate'], $data['raceEndDate'], $data['raceRank'], $data['raceInfo'], user()->getId());
            if ($Experience->save()) {
                redirect('profile');
            }

        }
    }

    public function delete($id)
    {
        $Experience = new Experience($id);
        if ($Experience->delete()) {
            redirect('profile');
        }
    }

}