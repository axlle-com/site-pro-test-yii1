<?php

function axObjectToArray($array): ?array
{
    if (is_object($array) || is_array($array)) {
        $ret = (array)$array;
        foreach ($ret as &$item) {
            $item = axObjectToArray($item);
        }
        return $ret;
    }
    return $array;
}

function axClearArray(array $array): array
{
    $newArr = [];
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $newArr[$key] = axClearArray($value);
            } else {
                $newArr[$key] = $value ? axClearData($value) : $value;
            }
        }
    }
    return $newArr;
}

function axClearData($string)
{
    if (is_numeric($string)) {
        return $string;
    }
    $string = preg_replace('/([^\pL\pN\pP\pS\pZ])|([\xC2\xA0])/u', ' ', $string);
    $string = preg_replace('/ {2,}/', ' ', strip_tags(html_entity_decode($string)));
    return trim($string);
}

function axClearPhone(string $phone): string
{
    return preg_replace('/[\D]/', '', $phone);
}

function axPrettyPhone(string $phone): string
{
    $phone = preg_replace('[^0-9]', '', $phone);
    if (strlen($phone) != 10) {
        $phone = substr($phone, 1);
    }
    $sArea = substr($phone, 0, 3);
    $sPrefix = substr($phone, 3, 3);
    $sNumber = substr($phone, 6, 4);
    return '+7(' . $sArea . ')' . $sPrefix . '-' . $sNumber;
}

function axUnixToStringUTC(int $string): string
{
    $unixTime = time();
    $timeZone = new DateTimeZone('UTC');

    $time = new DateTime();
    $time->setTimestamp($unixTime)->setTimezone($timeZone);

    return $time->format('d.m.Y H:i:s');
}

function axStringToUnixUTC(string $string, string $time = '00:00:00'): int
{
    return (new DateTime(trim($string) . ' ' . $time, new DateTimeZone('UTC')))->getTimestamp();
}

function axStringToUnixMoscow(string $string = 'NOW'): int
{
    return (new DateTime(trim($string), new DateTimeZone('Europe/Moscow')))->getTimestamp();
}

function axStringToUnixUTCPeriod(string $string): array
{
    $dateRange = explode('-', $string);
    return [axStringToUnixUTC($dateRange[0]), axStringToUnixUTC($dateRange[1], '23:59:59')];
}

function axClearPhoneByLogin(?string $phone): ?string
{
    return $phone ? preg_replace('/^\+7/', '', $phone) : null;
}

function axQueryString(array $data): string
{
    $string = '';
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $item) {
                $string .= $key . '[]=' . $item . '&';
            }
        } elseif (isset($value)) {
            $string .= $key . '=' . $value . '&';
        }
    }
    return substr($string, 0, -1);
}

function axGenPassword($length = 6): string
{
    $chars = 'qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
    $symbols = '?!$#&*(){}[]@+=-_~^%';
    $size = strlen($chars) - 1;
    $sizeSymbols = strlen($symbols) - 1;
    $password = '';
    while ($length--) {
        $password .= $chars[random_int(0, $size)];
        $password .= $symbols[random_int(0, $sizeSymbols)];
    }
    return $password;
}

function axStringToDouble(string $string): float
{
    return (double)str_replace(',', '.', $string);
}

function axPrettyPrint($in, $opened = true): string
{
    if ($opened) {
        $opened = ' open';
    }
    $string = '';
    if (is_object($in) || is_array($in)) {
        $string .= '<div>';
        $string .= '<div>' . ((is_object($in)) ? 'Object {' : 'Array [') . '</div>';
        $string .= axPrettyPrintRec($in, $opened);
        $string .= '<div>' . ((is_object($in)) ? '}' : ']') . '</div>';
        $string .= '</div>';
    }
    return $string;

}

function axPrettyPrintRec($in, $opened, $margin = 10): string
{
    if (!is_object($in) && !is_array($in)) {
        return '';
    }
    $inner = '';
    foreach ($in as $key => $value) {
        if (is_object($value) || is_array($value)) {
            $inner .= '<div style="margin-left:' . $margin . 'px">';
            $inner .= '<span>' . ((is_object($value)) ? $key . ' {' : $key . ' [') . '</span>';
            $inner .= prettyPrintRec($value, $opened, $margin + 5);
            $inner .= '<span>' . ((is_object($value)) ? '}' : ']') . '</span>';
            $inner .= '</div>';
        } else {
            $color = '';
            switch (gettype($value)) {
                case 'string':
                    $color = 'red';
                    break;
                case 'integer':
                    $color = 'blue';
                    break;
                case 'double':
                    $color = 'green';
                    break;
            }
            $inner .= '<div style="margin-left:' . $margin . 'px">' . $key . ' : <span style="color:' . $color . '">' . $value . '</span></div>';
        }
    }
    return $inner;
}

function axGetResponseServer(string $url): bool
{
    $header = 0;
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 5,
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    curl_exec($ch);
    if (!curl_errno($ch)) {
        $header = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    }
    curl_close($ch);
    return $header === 200;
}

function axGetDate(string $date): string
{
    $publisherYear = date('Y', strtotime($date));
    $publisherMonth = date('m', strtotime($date));
    return $date ? axMonthArray()[$publisherMonth] . ' ' . $publisherYear : '';
}

function axMonthArray(): array
{
    return [
        '01' => 'Янв',
        '02' => 'Фев',
        '03' => 'Мар',
        '04' => 'Апр',
        '05' => 'Май',
        '06' => 'Июн',
        '07' => 'Июл',
        '08' => 'Авг',
        '09' => 'Сен',
        '10' => 'Окт',
        '11' => 'Ноя',
        '12' => 'Дек',
    ];

}

function axGetFullDate(string $date): string
{
    $publisherYear = date('Y', strtotime($date));
    $publisherMonth = date('m', strtotime($date));
    return $date ? axMonthFullArray()[$publisherMonth] . ' ' . $publisherYear : '';
}

function axMonthFullArray(): array
{
    return [
        '01' => 'Январь',
        '02' => 'Февраль',
        '03' => 'Март',
        '04' => 'Апрель',
        '05' => 'Май',
        '06' => 'Июнь',
        '07' => 'Июль',
        '08' => 'Август',
        '09' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'Декабрь',
    ];
}

function axTableList(): array
{
    $array = [];
    foreach (DB::select("SELECT table_name FROM information_schema.tables WHERE table_catalog = 'sanador' AND table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;") as $tableName) {
        foreach ($tableName as $name) {
            $model = table($name);
//                if (strripos($model, '_has_')) {
//                    continue;
//                }
            $array[$model] = $model;
        }
    }
    return $array;
}

function axTableName(string $name): string
{
    $array = ['{', '}', '%'];
    return str_replace($array, '', $name);
}

function axSubstr(string $text, int $end = 300, int $start = 0): string
{
    $text = axClearData($text);
    $text = substr($text, $start, $end);
    $text = rtrim($text, '!,.-');
    $text = substr($text, 0, strrpos($text, ' '));
    return $text . ' … ';
}
