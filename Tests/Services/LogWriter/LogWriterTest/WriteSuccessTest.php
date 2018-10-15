<?php

namespace Tests\Services\LogWriter\LogWriterTest;

use Tests\Services\LogWriter\LogWriterTest;

class WriteSuccessTest extends LogWriterTest
{
    /**
     * Test write method
     *
     * @covers \Services\LogWriter\LogWriter::write()
     * @dataProvider writerDataProvider
     */
    public function testWriteSuccess(string $fileName, string $data)
    {
        $writtenBytes = $this->logWriter->write($fileName, $data);

        $this->assertNotEmpty($writtenBytes);
        $this->assertInternalType('int', $writtenBytes);
    }

    /**
     * @return array
     */
    public function writerDataProvider(): array
    {
        return [
            ['Tests/storage/logs/test_battle_logs/test_path_1.log', 'test_1 - ' . date('Y_m_d_His') . PHP_EOL],
            ['Tests/storage/logs/test_battle_logs/test_path_2.log', 'test_2 - ' . date('Y_m_d_His') . PHP_EOL],
        ];
    }
}
