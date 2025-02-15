<?php
class CyclistController extends BaseController
{

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
        $cyclist = Cyclist::findCyclist(user()->getId());
        $this->render("cyclist/profile/index", compact("cyclist"));
    }

    public function unverifiedCyclists()
    {
        $this->render("admin/unverified-cyclists/index");
    }
    
    public function update()
    {
        $cyclist = Cyclist::findCyclist(user()->getId());
            $team = $_POST['teamInput'];
            $Nationality = $_POST['NationalityInput'];
            $Birthdate = $_POST['BirthdateInput'];
            $Email = $_POST['EmailInput'];

            $ProfilPhoto = '';
            if ($_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (in_array($_FILES['profileImage']['type'], $allowedTypes)) {
                    $uploadDir = IMAGESROOT . 'photos/';
                    
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
        
                    $ProfilPhoto = time() . '_' . basename($_FILES['profileImage']['name']);
                    $thumbnailPath = $uploadDir . $ProfilPhoto;
        
                    if (!move_uploaded_file($_FILES['profileImage']['tmp_name'], $thumbnailPath)) {
                        $errors['thumbnail_err'] = 'Failed to upload the thumbnail.';
                    }
                } else {
                    $errors['thumbnail_err'] = 'Invalid image format. Allowed formats are JPG, PNG, and GIF.';
                }

                $cyclist->setPhoto($ProfilPhoto);
            }

            if ($Birthdate != null) {
                $cyclist->setBirthdate($Birthdate);
            }
            
            $cyclist->setNationality($Nationality);
            $cyclist->setEmail($Email);
            $cyclist->setTeam($team);
            

            $cyclist->update();

        
        
        redirect("profile");
    }

    
    public function ranking()
    {   
        $TopCyclists = Cyclist::getTopCyclists(3); 
        $Cyclists = Cyclist::getTopCyclists(); 
        $this->render("/fan/ranking/index", compact("Cyclists", "TopCyclists"));
    }
}
