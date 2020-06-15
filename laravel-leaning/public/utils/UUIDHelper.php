<?php

/*
 *
 * Помощник для генерации UUID
 *
 * Но его стоит использовать с умом=)
 * Комментарии русскими буквами писать не буду
 * ибо так неудобно
 *
 */

//strict types declared, because we aren't in the cave age =)
declare(strict_types=1);

namespace ZloyNick;

use InvalidArgumentException;

use function strlen;
use function pack;
use function getmypid;
use function hash;
use function implode;
use function unpack;

//Почему я занялся "чертовщиной" выше?
//Да потому что инициализированные функции работают ~на 50% быстрее.
//С классами всё же иначе. Здесь спорный процент есть, но всё же,
//зато не режет глаза.

//Такие фишки играют на 10-15% производительности в крупных проектах.

/**
 * @deprecated
 */
final class UUIDHelper
{

    /** @var int[] */
    private
        $parts =
        [
            0,
            0,
            0,
            0
        ];

    /**
     * UUIDHelper constructor.
     *
     * @param int $part1
     * @param int $part2
     * @param int $part3
     * @param int $part4
     */
    public function __construct($part1 = 0, $part2 = 0, $part3 = 0, $part4 = 0){
        $this->parts[0] = (int) $part1;
        $this->parts[1] = (int) $part2;
        $this->parts[2] = (int) $part3;
        $this->parts[3] = (int) $part4;
    }


    /**
     * Возвращает класс UUIDHelper, в котором есть значение самого UUID.
     * См. __toString()
     *
     * @return UUIDHelper
     */
    public static function fromRandom() : UUIDHelper
    {
        return
            self::fromData(
                static::generateInt(
                    time()
                ),

                static::generateShort(
                    getmypid()
                ),

                static::generateShort(
                    getmyuid()
                ),

                static::generateInt(
                    mt_rand(-0x7fffffff, 0x7fffffff)
                ),

                static::generateInt(
                    mt_rand(-0x7fffffff, 0x7fffffff)
                )
            );
    }

    /**
     * Генерирует бинарную строку
     *
     * @param mixed ...$data
     * @return UUIDHelper
     */
    public static function fromData(...$data) : UUIDHelper
    {
        $hash = hash("md5", implode($data), true);

        return static::fromBinary($hash);
    }

    /**
     * Думаю, тут без комментариев.
     *
     * @param $value
     * @return false|string
     */
    public static function generateInt($value) : string{
        return pack("N", $value);
    }

    /**
     * #L110
     *
     * @param $value
     * @return false|string
     */
    public static function generateShort($value) : string{
        return pack("n", $value);
    }

    /**
     * #L110
     *
     * @param string $uuid
     * @return UUIDHelper
     */
    public static function fromBinary(string $uuid) : UUIDHelper{

        if(strlen($uuid) !== 16){
            throw new InvalidArgumentException("Must have exactly 16 bytes");
        }

        return
            new UUIDHelper(
                static::getInt(substr($uuid, 0, 4)),
                static::getInt(substr($uuid, 4, 4)),
                static::getInt(substr($uuid, 8, 4)),
                static::getInt(substr($uuid, 12, 4)));
    }

    /**
     * #L110
     *
     * @param string $str
     * @return int|mixed
     */
    public static function getInt(string $str) : int{
        if(PHP_INT_SIZE === 8){
            return unpack("N", $str)[1] << 32 >> 32;
        }else{
            return unpack("N", $str)[1];
        }
    }


    /**
     * @return string
     */
    final public function __toString() : string
    {
        $parts = $this->parts;
        return $parts[0].'-'.$parts[1].'-'.$parts[2].'-'.$parts[3];
    }

}
