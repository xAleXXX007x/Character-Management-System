<?php

namespace App\Notifications;

use App\Models\Character;
use NotificationChannels\Discord\DiscordMessage;

class CharacterCompleteDeletionNotification extends DiscordNotification
{
    public $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function toDiscord($notifiable)
    {
        $url = route('characters.show', $this->character);
        $character = $this->character;
        $embed = [
            'title' => "Ваш персонаж '$character->name' полностью удалён",
            'description' => 'Его нельзя восстановить.
            
            ***Помянем***',
            'url' => $url,
            'timestamp' => now(),
            'color' => 0xEF4444,
            'image' => [
                'url' => asset($character->reference)
            ],
            'fields' => [
                [
                    'name' => 'Пол',
                    'value' => $character->gender->description,
                    'inline' => true
                ],
                [
                    'name' => 'Раса',
                    'value' => $character->race,
                    'inline' => true
                ],
                [
                    'name' => 'Возраст',
                    'value' => $character->age,
                    'inline' => true
                ],
                [
                    'name' => 'Описание',
                    'value' => $character->description
                ]
            ]
        ];

        return DiscordMessage::create('', array_merge($this->embed, $embed));
    }
}