<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Used to run tests on the Quote API. 
 */
class QuoteApiTest extends TestCase
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
     * when attempting to get all quotes from the API. 
     *
     * @return void
     */
    public function testGettingAllQuotesSuccessfully()
    {
        $response = $this->json('GET', '/api/quotes');

        $response->assertJsonStructure([
            'quotes' => ['*' =>
                [
                    'id',
                    'created_at',
                    'updated_at',
                    'quote',
                    'author_name'
                ]
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * Testing correct response status and structure for getting 
     * quote with id 1 
     *
     * @return void
     */
    public function testGettingSpecificQuoteThatExists()
    {
        $response = $this->json('GET', '/api/quote/details/1');

        $response->assertJsonStructure([
            'quote' => [
                    'id',
                    'created_at',
                    'updated_at',
                    'quote',
                    'author_name'
                ]
            ]);
        $response->assertStatus(200);

    }

    /**
     * Testing correct response structure and status
     * is returned when a quote does not exist
     *
     * @return void
     */
    public function testGettingSpecificQuoteThatDoesNotExist()
    {
        $response = $this->json('GET', '/api/quote/details/-1');
        
        $response->assertJsonStructure([
            'message'
            ]);
        $response->assertStatus(404);

    }

    /**
     * Testing correct response structure and status
     * is returned when creating a quote successfully
     *
     * @return void
     */
    public function testCreatingAQuoteSuccessfully()
    {
        $data = [
            'quote'=> 'This is a test', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('POST', '/api/quote', $data);
        
        $response->assertJsonStructure([
            'quote' => [
                'id',
                'created_at',
                'updated_at',
                'quote',
                'author_name'
            ],
            'message'
            ]);
        $response->assertStatus(201);

    }
    
    /**
     * Testing quote is indeed added to the database successfully. 
     * 
     * @return void
     */
    public function testCreatingAQuoteAddedToDatabaseSuccessfully()
    {
        $data = [
            'quote'=> 'This is a test', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('POST', '/api/quote', $data);

        $this->assertDatabaseHas('quotes', [
            'quote'=> 'This is a test', 
            'author_name'=> 'Jeffrey Boisvert'
        ]);

    }

    /**
     * Testing correct response status
     * is returned when attemping to create a quote missing just 
     * the quote parameter
     *
     * @return void
     */
    public function testCreatingAQuoteMissingJustQuoteParameter()
    {
        $data = [
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('POST', '/api/quote', $data);
        
        $response->assertStatus(422);

    }

    /**
     * Testing correct response structure and status
     * is returned when creating a quote that already exist.
     * This is specific to the quote parameter not author
     *
     * @return void
     */
    public function testCreatingAQuoteThatAlreadyExists()
    {
        $data = [
            'quote'=> 'I do not fear computers. I fear lack of them.', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('POST', '/api/quote', $data);
        
        $response->assertStatus(422);

    }

    /**
     * Testing correct response status
     * is returned when attemping to create a quote missing just 
     * the author_name parameter
     *
     * @return void
     */
    public function testCreatingAQuoteMissingJustAuthorParameter()
    {
        $data = [
            'quote'=> 'This is a test'
            ];
        $response = $this->json('POST', '/api/quote', $data);
        
        $response->assertStatus(422);

    }

    /**
     * Testing correct response status
     * is returned when attemping to create a quote missing just 
     * all parameters
     *
     * @return void
     */
    public function testCreatingAQuoteMissingAllParameters()
    {
        $data = [
            ];
        $response = $this->json('POST', '/api/quote', $data);
        
        $response->assertStatus(422);

    }

    /**
     * Testing updating quote returns correct status and response
     * when update was successful
     * 
     * @return void
     */
    public function testUpdatingQuoteSuccesfully()
    {
        $data = [
            'quote'=> 'This is a test update', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('PUT', '/api/quote/update/1', $data);

        $response->assertJsonStructure([
            'quote' => [
                'id',
                'created_at',
                'updated_at',
                'quote',
                'author_name'
            ],
            'message'
            ]);
        $response->assertStatus(200);

    }

    /**
     * Testing updating quote is in database
     * when update was successful
     * 
     * @return void
     */
    public function testUpdatingQuoteSuccesfullyInDatabase()
    {
        $data = [
            'quote'=> 'This is a test update', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('PUT', '/api/quote/update/1', $data);

        $this->assertDatabaseHas('quotes', [
            'quote'=> 'This is a test update', 
            'author_name'=> 'Jeffrey Boisvert'
        ]);
    }

    /**
     * Testing correct response structure and status
     * is returned when updating a quote that already exist.
     * This is specific to the quote parameter not author
     *
     * @return void
     */
    public function testUpdatingAQuoteThatAlreadyExists()
    {
        $data = [
            'quote'=> 'I do not fear computers. I fear lack of them.', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('PUT', '/api/quote/update/1', $data);
        
        $response->assertStatus(422);

    }

    /**
     * Testing updating quote that does not exist 
     * returns expected result
     * 
     * @return void
     */
    public function testUpdatingQuoteThatDoesNotExist()
    {
        $data = [
            'quote'=> 'This is a test update', 
            'author_name'=> 'Jeffrey Boisvert'
            ];
        $response = $this->json('PUT', '/api/quote/update/-1', $data);

        $response->assertJsonStructure([
            'message'
            ]);
        $response->assertStatus(404);
    }

    /**
     * Testing updating quote by only passing the quote parameter
     * is successfuly and returns the corret response.
     * 
     * @return void
     */
    public function testUpdatingQuoteSuccessfulWithJustQuoteParamater()
    {
        $data = [
            'quote'=> 'This is a test update', 
            ];
        $response = $this->json('PUT', '/api/quote/update/1', $data);

        $response->assertJsonStructure([
            'quote' => [
                'id',
                'created_at',
                'updated_at',
                'quote',
                'author_name'
            ],
            'message'
            ]);
        $response->assertStatus(200);
    }

    /**
     * Testing updating quote by only passing the author_name parameter
     * is successfuly and returns the corret response.
     * 
     * @return void
     */
    public function testUpdatingQuoteSuccessfulWithJustAuthorNameParamater()
    {
        $data = [
            'author_name'=> 'Jeff B.', 
            ];
        $response = $this->json('PUT', '/api/quote/update/1', $data);

        $response->assertJsonStructure([
            'quote' => [
                'id',
                'created_at',
                'updated_at',
                'quote',
                'author_name'
            ],
            'message'
            ]);
        $response->assertStatus(200);
    }

    /**
     * Testing updating quote by passing no parameters 
     * causing the update to fail correctly. 
     * 
     * @return void
     */
    public function testUpdatingQuoteUnsuccessfulWithNoParamaters()
    {
        $data = [
            ];
        $response = $this->json('PUT', '/api/quote/update/1', $data);

        $response->assertStatus(422);
    }

    /**
     * Testing deleting quote returns the correct response. 
     * 
     * @return void
     */
    public function testDeletingQuoteSuccessfully()
    {

        $response = $this->json('DELETE', '/api/quote/delete/1');

        $response->assertJsonStructure([
            'message'
            ]);
        $response->assertStatus(200);
    }

    /**
     * Testing deleting quote is reflected in the database 
     * 
     * @return void
     */
    public function testDeletingQuoteSuccessfullyInDatabase()
    {

        $response = $this->json('DELETE', '/api/quote/delete/1');

        $this->assertDatabaseMissing('quotes', [
            'quote' => 'Don\'t cry because it\'s over, smile because it happened.',
            'author_name' => 'Dr. Seuss'
        ]);

    }

    /**
     * Testing deleting quote that does not exist
     * 
     * @return void
     */
    public function testDeletingQuoteThatDoesNotExist()
    {

        $response = $this->json('DELETE', '/api/quote/delete/-1');

        $response->assertJsonStructure([
            'message'
            ]);
        $response->assertStatus(404);

    }

}
