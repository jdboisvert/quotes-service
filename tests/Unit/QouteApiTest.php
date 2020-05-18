<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Used to run tests on the Qoute API. 
 */
class QouteApiTest extends TestCase
{

    //Ensure database is cleaned and in good state
    use RefreshDatabase;

    /**
     * Runs after each test. Ensures database is seeded correctly. 
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
   }

    /**
     * Testing correct response status and structure
     * when attempting to get all qoutes from the API. 
     *
     * @return void
     */
    public function testGettingAllQoutesSuccessfully()
    {
        $response = $this->json('GET', '/api/qoutes');

        $response->assertJsonStructure([
            'qoutes' => ['*' =>
                [
                    'id',
                    'created_at',
                    'updated_at',
                    'qoute',
                    'author_name'
                ]
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * Testing correct response status and structure for getting 
     * qoute with id 1 
     *
     * @return void
     */
    public function testGettingSpecificQouteThatExists()
    {
        $response = $this->json('GET', '/api/qoute/details/1');

        $response->assertJsonStructure([
            'qoute' => [
                    'id',
                    'created_at',
                    'updated_at',
                    'qoute',
                    'author_name'
                ]
            ]);
        $response->assertStatus(200);

    }

    /**
     * Testing correct response structure and status
     * is returned when a qoute does not exist
     *
     * @return void
     */
    public function testGettingSpecificQouteThatDoesNotExist()
    {
        $response = $this->json('GET', '/api/qoute/details/-1');
        
        $response->assertJsonStructure([
            'message'
            ]);
        $response->assertStatus(404);

    }

    /**
     * Testing correct response structure and status
     * is returned when creating a qoute successfully
     *
     * @return void
     */
    public function testCreatingAQouteSuccessfully()
    {
        $data = [
            'qoute'=> 'This is a test', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('POST', '/api/qoute', $data);
        
        $response->assertJsonStructure([
            'qoute' => [
                'id',
                'created_at',
                'updated_at',
                'qoute',
                'author_name'
            ],
            'message'
            ]);
        $response->assertStatus(201);

    }
    
    /**
     * Testing qoute is indeed added to the database successfully. 
     * 
     * @return void
     */
    public function testCreatingAQouteAddedToDatabaseSuccessfully()
    {
        $data = [
            'qoute'=> 'This is a test', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('POST', '/api/qoute', $data);

        $this->assertDatabaseHas('qoutes', [
            'qoute'=> 'This is a test', 
            'author_name'=> 'Jeffrey Boisvert'
        ]);

    }

    /**
     * Testing correct response status
     * is returned when attemping to create a qoute missing just 
     * the qoute parameter
     *
     * @return void
     */
    public function testCreatingAQouteMissingJustQouteParameter()
    {
        $data = [
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('POST', '/api/qoute', $data);
        
        $response->assertStatus(422);

    }


    /**
     * Testing correct response status
     * is returned when attemping to create a qoute missing just 
     * the author_name parameter
     *
     * @return void
     */
    public function testCreatingAQouteMissingJustAuthorParameter()
    {
        $data = [
            'qoute'=> 'This is a test'
            ];
        $response = $this->json('POST', '/api/qoute', $data);
        
        $response->assertStatus(422);

    }

    /**
     * Testing correct response status
     * is returned when attemping to create a qoute missing just 
     * all parameters
     *
     * @return void
     */
    public function testCreatingAQouteMissingAllParameters()
    {
        $data = [
            ];
        $response = $this->json('POST', '/api/qoute', $data);
        
        $response->assertStatus(422);

    }

    /**
     * Testing updating qoute returns correct status and response
     * when update was successful
     * 
     * @return void
     */
    public function testUpdatingQouteSuccesfully()
    {
        $data = [
            'qoute'=> 'This is a test update', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('PUT', '/api/qoute/update/1', $data);

        $response->assertJsonStructure([
            'qoute' => [
                'id',
                'created_at',
                'updated_at',
                'qoute',
                'author_name'
            ],
            'message'
            ]);
        $response->assertStatus(200);

    }

    /**
     * Testing updating qoute is in database
     * when update was successful
     * 
     * @return void
     */
    public function testUpdatingQouteSuccesfullyInDatabase()
    {
        $data = [
            'qoute'=> 'This is a test update', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('PUT', '/api/qoute/update/1', $data);

        $this->assertDatabaseHas('qoutes', [
            'qoute'=> 'This is a test update', 
            'author_name'=> 'Jeffrey Boisvert'
        ]);
    }

    /**
     * Testing updating qoute that does not exist 
     * returns expected result
     * 
     * @return void
     */
    public function testUpdatingQouteThatDoesNotExist()
    {
        $data = [
            'qoute'=> 'This is a test update', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('PUT', '/api/qoute/update/-1', $data);

        $response->assertJsonStructure([
            'message'
            ]);
        $response->assertStatus(404);
    }

    /**
     * Testing updating qoute by only passing the qoute parameter
     * is successfuly and returns the corret response.
     * 
     * @return void
     */
    public function testUpdatingQouteSuccessfulWithJustQouteParamater()
    {
        $data = [
            'qoute'=> 'This is a test update', 
            ];
        $response = $this->json('PUT', '/api/qoute/update/1', $data);

        $response->assertJsonStructure([
            'qoute' => [
                'id',
                'created_at',
                'updated_at',
                'qoute',
                'author_name'
            ],
            'message'
            ]);
        $response->assertStatus(200);
    }

    /**
     * Testing updating qoute by only passing the author_name parameter
     * is successfuly and returns the corret response.
     * 
     * @return void
     */
    public function testUpdatingQouteSuccessfulWithJustAuthorNameParamater()
    {
        $data = [
            'author_name'=> 'Jeff B.', 
            ];
        $response = $this->json('PUT', '/api/qoute/update/1', $data);

        $response->assertJsonStructure([
            'qoute' => [
                'id',
                'created_at',
                'updated_at',
                'qoute',
                'author_name'
            ],
            'message'
            ]);
        $response->assertStatus(200);
    }

    /**
     * Testing updating qoute by passing no parameters 
     * causing the update to fail correctly. 
     * 
     * @return void
     */
    public function testUpdatingQouteUnsuccessfulWithNoParamaters()
    {
        $data = [
            ];
        $response = $this->json('PUT', '/api/qoute/update/1', $data);

        $response->assertStatus(422);
    }

    /**
     * Testing deleting qoute returns the correct response. 
     * 
     * @return void
     */
    public function testDeletingQouteSuccessfully()
    {

        $response = $this->json('DELETE', '/api/qoute/delete/1');

        $response->assertJsonStructure([
            'message'
            ]);
        $response->assertStatus(200);
    }

    /**
     * Testing deleting qoute is reflected in the database 
     * 
     * @return void
     */
    public function testDeletingQouteSuccessfullyInDatabase()
    {

        $response = $this->json('DELETE', '/api/qoute/delete/1');

        $this->assertDatabaseMissing('qoutes', [
            'qoute' => 'Don\'t cry because it\'s over, smile because it happened.',
            'author_name' => 'Dr. Seuss'
        ]);

    }

    /**
     * Testing deleting qoute that does not exist
     * 
     * @return void
     */
    public function testDeletingQouteThatDoesNotExist()
    {

        $response = $this->json('DELETE', '/api/qoute/delete/-1');

        $response->assertJsonStructure([
            'message'
            ]);
        $response->assertStatus(404);

    }

}
