<?php

namespace app\components;

use yii\authclient\BaseClient;

/**
 * Description of ServiceProviderHandler
 *
 * @author charles
 */
class ServiceProviderHandler
{

    /**
     *
     * @var BaseClient
     */
    private $client = null;

    /**
     *
     * @param BaseClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $type = get_class($this->client);
        $result = [];
        switch ($type) {
            case 'yii\authclient\clients\Google':
                $result = $this->handleGoogle();
                break;
            case 'app\components\Coding':
                $result = $this->handleCoding();
                break;
            case 'app\components\WeWork':
                $result = $this->handleWeWork();
                break;
            default:
                break;
        }

        return $result;
    }

    protected function handleGoogle()
    {
        $attributes = [];
        $data = $this->client->getUserAttributes();
        foreach ($data['emails'] as $email) {
            if ($email['type'] == 'account') {
                $attributes['email'] = $email['value'];
                break;
            }
        }
        $attributes['nickname'] = $data['displayName'];
        $attributes['username'] = substr($attributes['email'], 0, strpos($attributes['email'], '@'));
        return $attributes;
    }

    protected function handleCoding()
    {
    }

    /**
     * This treat WeWork api
     * @link https://work.weixin.qq.com/api/doc
     * @return array
     */
    protected function handleWeWork()
    {
        $attributes = [];
        $data = $this->client->getUserAttributes();
        $attributes['email'] = $data['email'];
        $attributes['username'] = $data['userid'];
        $attributes['nickname'] = $data['name'];
        return $attributes;
    }
}
