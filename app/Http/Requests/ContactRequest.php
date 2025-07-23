    <?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ContactRequest extends FormRequest
    {
        public function authorize()
        {
            return true;
        }

        public function rules()
        {
            return [
                'name'    => 'required|string|max:100',
                'email'   => 'required|email',
                'content' => 'required|string|max:1000',
            ];
        }
    }
