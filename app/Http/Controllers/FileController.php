<?php


namespace App\Http\Controllers;

header('Content-Type: text/plain; charset=utf-8');

// Include the AWS SDK using the Composer autoloader
require '../vendor/autoload.php';

use DB;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function view()
    {
      /*
       If you instantiate a new client for Amazon Simple Storage Service (S3) with
       no parameters or configuration, the AWS SDK for PHP will look for access keys
       in the following order: environment variables, ~/.aws/credentials file, then finally
       IAM Roles for Amazon EC2 Instances. The first set of credentials the SDK is able
       to find will be used to instantiate the client.
       For more information about this interface to Amazon S3, see:
       http://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/basic-usage.html#creating-a-client
      */
      // $s3 = new Aws\S3\S3Client([
      //     'version' => 'latest',
      //     'region'  => 'us-west-2'
      // ]);
      $sharedConfig = [
          'region'  => 'us-west-2',
          'version' => 'latest'
      ];

      // Create an SDK class used to share configuration across clients.
      $sdk = new Aws\Sdk($sharedConfig);

      // Create an Amazon S3 client using the shared configuration data.
      $client = $sdk->createS3();
      /*
       Everything uploaded to Amazon S3 must belong to a bucket. These buckets are
       in the global namespace, and must have a unique name.
       For more information about bucket name restrictions, see:
       http://docs.aws.amazon.com/AmazonS3/latest/dev/BucketRestrictions.html
      */
      $bucket = uniqid("lyfevinyl.jonnyforney.com", true);
      echo "Creating bucket named {$bucket}\n";
      $s3->createBucket(['Bucket' => $bucket]);
      // Wait until the bucket is created
      $s3->waitUntil('BucketExists', ['Bucket' => $bucket]);
      /*
       Files in Amazon S3 are called "objects" and are stored in buckets. A specific
       object is referred to by its key (i.e., name) and holds data. Here, we create
       a new object with the key "hello_world.txt" and content "Hello World!".
       For a detailed list of putObject's parameters, see:
       http://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#putobject
      */
      $key = 'hello_world.txt';
      echo "Creating a new object with key {$key}\n";
      $s3->putObject([
          'Bucket' => $bucket,
          'Key'    => $key,
          'Body'   => "Hello World!"
      ]);
      /*
       Now, let's download the object and read the body directly.
       For more examples of downloading objects, see the developer guide:
       http://docs.aws.amazon.com/aws-sdk-php-2/guide/latest/service-s3.html#downloading-objects
       Or the API documentation:
       http://docs.aws.amazon.com/aws-sdk-php-2/latest/class-Aws.S3.S3Client.html#_getObject
      */
      // echo "Downloading that same object:\n";
      // $result = $s3->getObject([
      //     'Bucket' => $bucket,
      //     'Key'    => $key
      // ]);
      // echo "\n---BEGIN---\n";
      // echo $result['Body'];
      // echo "\n----END----\n\n";
      /*
       You can perform the same upload and download operations using Amazon S3 Stream Wrappers,
       which allow you to store and retrieve data from Amazon S3 using PHP's built-in functions
       like file_get_contents, fopen, copy, etc.
       For more information about stream wrappers, see the Amazon S3 Stream Wrapper
       section in the developer guide:
       http://docs.aws.amazon.com/aws-sdk-php/v3/guide/service/s3-stream-wrapper.html
      */
      // First, you need register the stream wrappers.
      // $s3->registerStreamWrapper();
      // // Now you can use addresses such as s3://bucket/key as with built-in functions as shown below.
      // $key2 = 'hello_again_world.txt';
      // echo "Creating a second object with key {$key2} using stream wrappers\n";
      // file_put_contents("s3://{$bucket}/{$key2}", 'Hello Again!');
      // // Let's get the contents of this object.
      // echo "Downloading that same object:\n";
      // $data = file_get_contents("s3://{$bucket}/{$key2}");
      // echo "\n---BEGIN---\n";
      // echo $data;
      // echo "\n----END----\n\n";
      /*
       Now, we want to delete the bucket. Buckets cannot be deleted unless they're empty.
       With the AWS SDK for PHP, you have a few options when deleting multiple objects:
        - Use deleteMatchingObjects method:
            http://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.S3.S3Client.html#_deleteMatchingObjects
        - Use the BatchDelete helper:
            http://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.S3.BatchDelete.html
        - Or individually delete the objects.
       We'll use the BatchDelete helper to delete the two objects we created.
      // */
      // echo "Deleting all objects in bucket {$bucket}\n";
      // $batch = Aws\S3\BatchDelete::fromListObjects($s3, ['Bucket' => $bucket]);
      // $batch->delete();
      /*
       Now that the bucket is empty, it can be deleted.
      */
      // echo "Deleting bucket {$bucket}\n";
      // $s3->deleteBucket(['Bucket' => $bucket]);
      /*
       Although this sample didn't check for errors when calling service operations,
       real-world applications should always check for errors.
       See the Error Handling section in the developer guide for more information:
       http://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/basic-usage.html#synchronous-error-handling
      */





    }

    public function send() {
      $to      = 'jesusdiedtosaveusfromoursins@gmail.com';
      $subject = 'the subject';
      $message = 'hello';
      $headers = 'From: webmaster@example.com' . "\r\n" .
                  'Reply-To: webmaster@example.com' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();
      echo $message;

      var_dump(mail($to, $subject, $message, $headers));
    }
}
