<?php

namespace App\Http\Livewire\Forms;

use App\Models\Contract;
use App\Modules\Helpers\ClassFactory;
use Livewire\Component;
use Tanthammar\TallForms\Input;
use Tanthammar\TallForms\TallForm;

class CreateContract extends Component
{
    use TallForm;

    public function mount(?Contract $contract)
    {
        //Gate::authorize()
        $this->fill([
            'formTitle' => trans('global.create').' '.trans('crud.contract.title_singular'),
            'wrapWithView' => true, //see https://github.com/tanthammar/tall-forms/wiki/Wrapper-Layout
            'showGoBack' => false,
        ]);
        $this->mount_form($contract); // $contract from hereon, called $this->model
    }


    // Mandatory method
    public function onCreateModel($validated_data)
    {
        // Set the $model property in order to conditionally display fields when the model instance exists, on saveAndStayResponse()
        $this->model = Contract::create($validated_data);
    }

    // OPTIONAL method used for the "Save and stay" button, this method already exists in the TallForm trait
    public function onUpdateModel($validated_data)
    {
        $this->model->update($validated_data);
    }

    public function fields()
    {
        $fields = [];
        $fieldClasses = ClassFactory::make('fields');

        foreach ($fieldClasses as $class) {
            $instance = new $class;
            $fields[] = $instance->field();
        }

        return $fields;
    }
}
