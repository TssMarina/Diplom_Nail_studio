<?php

namespace App\Request;

use App\Models\Appointment;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'time' => 'required',
            // тут проверка на наличие передаваемого айдишника в бд
            'favour_id' => 'required|exists:favour,id',
            // Поле имени минимум 2 буквы
            'name' => ['required', 'regex:/[а-яА-ЯёЁa-zA-Z]{2,}/mi'],
            // Поле телефона стандартное российское
            'phone' => ['required', 'regex:/^(\+7|7|8)[0-9]{10}$|max:11/'],
            // тут проверка на наличие передаваемого айдишника в бд
            'master_id' => 'required|exists:users,id',
        ];
    }

    public function save()
    {
        $date = Carbon::createFromFormat("d.m-H:i", $this->date.'-'.$this->time);
        $appointemnt = Appointment::create([
            'datetime' => $date,
            'favour_id' => $this->favour_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'master_id' => $this->master_id,
            'status' => "WAIT",
        ]);
        $calendar = Calendar::where('date', '=', $date->format('Y-m-d'))
            ->where('master_id', '=', $this->master_id)
            ->first();
        $time = json_decode($calendar->time);
        $time = array_filter($time, function ($item) {
            if ($item->time === $this->time) {
                $item->status = "busy";
            }
            return $item;
        });
        $calendar->update([
            'time' => $time,
        ]);
        return $appointemnt;
    }

    public function messages()
    {
        return [
            'phone.regex' => 'Неверный формат ввода',
            'phone.required' => 'Поле обязательно к заполнению',
            'name.required' => 'Поле обязательно к заполнению',
            'name.regex' => 'Имя должно содержать минимум 2 буквы',
        ];
    }

}
