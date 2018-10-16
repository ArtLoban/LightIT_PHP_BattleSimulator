<?php

namespace Tests\Services\LogWriter\LogWriterTest;

use Exception;
use Tests\Services\LogWriter\LogWriterTest;

class WriteExceptionTest extends LogWriterTest
{
    /**
     * Test write method throw exception
     *
     * @covers \Services\LogWriter\LogWriter::write()
     * @dataProvider writerDataProvider
     */
    public function testWriteException(?string $fileName, ?string $data)
    {
        $this->expectException(Exception::class);
        $this->logWriter->write($fileName, $data);
    }

    /**
     * @return array
     */
    public function writerDataProvider(): array
    {
        return [
            ['', 'test_string'],
        ];
    }
}
