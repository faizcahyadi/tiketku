<?php

namespace App\ViewModels;

class DemoEventCatalog
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                'slug' => 'pulang-sebelum-pagi',
                'title' => 'Pulang Sebelum Pagi',
                'genre' => 'Musik',
                'city' => 'Jakarta',
                'venue' => 'Taman Ismail Marzuki',
                'date' => '28 November 2026',
                'time' => '19.00 WIB',
                'price' => 175000,
                'summary' => 'Satu malam untuk lagu-lagu yang ingin dinyanyikan bersama.',
                'ticket_types' => [
                    ['name' => 'Regular', 'price' => 175000],
                    ['name' => 'Front Row', 'price' => 325000],
                ],
            ],
            [
                'slug' => 'ruang-nada',
                'title' => 'Ruang Nada',
                'genre' => 'Musik',
                'city' => 'Bandung',
                'venue' => 'Sasana Budaya Ganesha',
                'date' => '12 Desember 2026',
                'time' => '18.30 WIB',
                'price' => 125000,
                'summary' => 'Sesi musik akustik dengan jarak yang dekat antara panggung dan penonton.',
                'ticket_types' => [
                    ['name' => 'Regular', 'price' => 125000],
                    ['name' => 'Premium', 'price' => 250000],
                ],
            ],
            [
                'slug' => 'langkah-malam-5k',
                'title' => 'Langkah Malam 5K',
                'genre' => 'Olahraga',
                'city' => 'Surabaya',
                'venue' => 'Grand City',
                'date' => '10 Januari 2027',
                'time' => '20.00 WIB',
                'price' => 90000,
                'summary' => 'Lari santai lima kilometer dengan rute malam di pusat kota.',
                'ticket_types' => [
                    ['name' => 'Peserta', 'price' => 90000],
                ],
            ],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function filter(array $filters): array
    {
        $query = mb_strtolower(trim((string) ($filters['q'] ?? '')));
        $city = trim((string) ($filters['city'] ?? ''));
        $genre = trim((string) ($filters['genre'] ?? ''));

        return array_values(array_filter(self::all(), function (array $event) use ($query, $city, $genre): bool {
            $matchesQuery = $query === ''
                || str_contains(mb_strtolower($event['title'].' '.$event['venue'].' '.$event['city']), $query);
            $matchesCity = $city === '' || $event['city'] === $city;
            $matchesGenre = $genre === '' || $event['genre'] === $genre;

            return $matchesQuery && $matchesCity && $matchesGenre;
        }));
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function find(string $slug): ?array
    {
        foreach (self::all() as $event) {
            if ($event['slug'] === $slug) {
                return $event;
            }
        }

        return null;
    }

    /**
     * @return array<string, mixed>
     */
    public static function featured(): array
    {
        return self::all()[0];
    }
}
