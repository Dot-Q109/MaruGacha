<?php

use PHPUnit\Framework\TestCase;

/**
* @covers Menu
* @covers DatabaseModel
*/
class MenuTest extends TestCase
{
    protected function setUp(): void
    {
        $this->pdoMock = $this->createMock(PDO::class);
        $this->menu = new Menu($this->pdoMock);
    }

    protected function createStmtMock(array $mockResult)
    {
        // ステートメントモックを作成
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->expects($this->once())
                 ->method('fetch')
                 ->willReturn($mockResult);

        // PDOのモックがqueryメソッドでステートメントモックを返すように設定
        $this->pdoMock->expects($this->once())
                ->method('query')
                ->willReturn($stmtMock);

        return $stmtMock;
    }

    /**
    * @covers Menu::fetchRandomUdon
    */
    public function testFetchRandomUdon()
    {
        $mockResult = ['name' => 'かけうどん'];
        $this->createStmtMock($mockResult);
        $result = $this->menu->fetchRandomUdon();
        $this->assertSame($mockResult, $result);
    }

    /**
    * @covers Menu::fetchRandomTempura
    */
    public function testFetchRandomTempura()
    {
        $mockResult = ['name' => 'ちくわ天'];
        $this->createStmtMock($mockResult);
        $result = $this->menu->fetchRandomTempura();
        $this->assertSame($mockResult, $result);
    }
}
