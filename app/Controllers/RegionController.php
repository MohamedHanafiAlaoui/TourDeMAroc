<?php
class RegionController extends BaseController {

    public function index()
    {
        $regions = Region::All();
        $regionCount = Region::countRagion();
        $data =["region"=>$regions,"regionCount"=>$regionCount];
        $this->render("admin/regions/index",$data);
    }
    public function createRegion(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data = [
            "regions_name"=>array_map("trim",$_POST["regions_name"])
        ];
        $error = [
            "categories_name_err"=>""
        ];
        if(count(array_filter($data['regions_name'])) == 0){
            $error["categories_name_err"] = "Please enter region name";
        }
        if(empty($error['categories_name_err'])){
            foreach ($data['regions_name'] as $regions_name) {
                $region = new Region(null,$regions_name);
                $region->save();
            }
            flash("success","Region created successfully.");
            back();
        }
        flash("error", array_first_not_null_value($error));
        back();
    }
    public function delete(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = $_POST['region_id'];
        $region = Region::find($id);
        if (!$region || !$region->delete()) {
            flash("error", "Something went wrong.");
            back();
        }

        flash("success", "Category removed successfully.");
        back();
    }
    
}