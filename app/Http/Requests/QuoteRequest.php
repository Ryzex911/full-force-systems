<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Controle van het offerteformulier. De velden komen uit het wensenformulier (vraag 11):
 * naam, bedrijfsnaam, e-mail, telefoon, postcode/plaats, particulier/zakelijk, gewenste dienst, product(en), omschrijving.
 */
class QuoteRequest extends FormRequest
{
    /** Iedereen mag een aanvraag doen; je hoeft niet ingelogd te zijn. */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'klanttype' => ['required', Rule::in(['particulier', 'zakelijk'])],
            'naam' => ['required', 'string', 'max:100'],
            'bedrijfsnaam' => ['nullable', 'required_if:klanttype,zakelijk', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'telefoon' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'postcode_plaats' => ['nullable', 'string', 'max:100'],
            'dienst' => ['nullable', Rule::in(array_column(config('site.services'), 'slug'))],
            'producten' => ['nullable', 'string', 'max:255'],
            'omschrijving' => ['required', 'string', 'min:10', 'max:2000'],
            'website' => ['nullable'], // verborgen veld tegen spam, zie ContactController
        ];
    }

    /** Namen van de velden zoals de bezoeker ze ziet. */
    public function attributes(): array
    {
        return [
            'klanttype' => 'particulier of zakelijk',
            'naam' => 'naam',
            'bedrijfsnaam' => 'bedrijfsnaam',
            'email' => 'e-mailadres',
            'telefoon' => 'telefoonnummer',
            'postcode_plaats' => 'postcode en plaats',
            'dienst' => 'gewenste dienst',
            'producten' => 'product(en)',
            'omschrijving' => 'omschrijving',
        ];
    }

    /** Foutmeldingen in het Nederlands, met "u". */
    public function messages(): array
    {
        return [
            'required' => 'Vul uw :attribute in.',
            'klanttype.required' => 'Kies of u particulier of zakelijk bent.',
            'in' => 'Kies een geldige :attribute.',
            'bedrijfsnaam.required_if' => 'Vul uw bedrijfsnaam in.',
            'email' => 'Vul een geldig e-mailadres in, bijvoorbeeld naam@voorbeeld.nl.',
            'telefoon.regex' => 'Een telefoonnummer bevat alleen cijfers, spaties, + en -.',
            'omschrijving.required' => 'Vertel kort wat u wilt beveiligen.',
            'omschrijving.min' => 'Vertel iets meer: gebruik minimaal :min tekens.',
            'max' => 'De :attribute mag maximaal :max tekens zijn.',
        ];
    }

    /**
     * De aanvraag als nette lijst voor de e-mails, met de naam van de dienst in plaats van de slug.
     *
     * @return array<string, string|null>
     */
    public function aanvraag(): array
    {
        $gegevens = $this->safe()->except('website');
        $diensten = array_column(config('site.services'), 'title', 'slug');

        $gegevens['dienst'] = $diensten[$gegevens['dienst'] ?? ''] ?? null;

        return $gegevens;
    }
}
