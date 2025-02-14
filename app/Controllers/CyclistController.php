<?php
class CyclistController extends BaseController {

    public function index()
    {
        $this->render("fan/cyclists/index");
    }

    public function show($id)
    {
        $this->render("fan/cyclists/show");
    }

    public function profile()
    {
        $Teams = Team::fetchTeam();
        $cyclist = Cyclist::findCyclist(user()->getId());
        $this->render("cyclist/profile/index", compact("cyclist", "Teams"));
    }

    public function unverifiedCyclists()
    {
        $this->render("admin/unverified-cyclists/index");
    }
    
    public function updte()
    {
        if (isset($_POST)) {
            $team = $_POST['teamInput'];
            $Nationality = $_POST['NationalityInput'];
            $Birthdate = $_POST['BirthdateInput'];
            $Email = $_POST['EmailInput'];

            $ProfilPhoto = '';
            if ($_POST['photo']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (in_array($_POST['photo']['type'], $allowedTypes)) {
                    $uploadDir = IMAGESROOT . 'photos/';
                    
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
        
                    $ProfilPhoto = time() . '_' . basename($_POST['photo']['name']);
                    $thumbnailPath = $uploadDir . $ProfilPhoto;
        
                    if (!move_uploaded_file($_POST['photo']['tmp_name'], $thumbnailPath)) {
                        $errors['thumbnail_err'] = 'Failed to upload the thumbnail.';
                    }
                } else {
                    $errors['thumbnail_err'] = 'Invalid image format. Allowed formats are JPG, PNG, and GIF.';
                }

                $cyclist = new Cyclist(user()->getId());
                $cyclist->setNationality($Nationality);
                $cyclist->setEmail($Email);
                $cyclist->setBirthdate($Birthdate);
                $cyclist->setIdTeme($team);
                $cyclist->setPhoto($ProfilPhoto);
    
                $cyclist->updateInfor();
            }
            

        }
        // $this->profile();
    }
}