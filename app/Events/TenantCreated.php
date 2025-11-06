<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Tenant;  
use App\Models\Block;
use App\Models\Link;
use App\Models\Review;


class TenantCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Tenant $tenant)
    {
        $this->createAboutBlocks();
        $this->createCtaBlock();
        $this->createReviewsBlock();
        $this->createFaqBlock();
        $this->createLinksBlock();
        $this->createFeaturesBlock();
    }

  
    public function createAboutBlocks()
    {
        $block = new Block();
        $block->tenant_id = $this->tenant->id;
        $block->active = true;
        $block->name = 'about';
        $block->config->set('title', 'من نحن');
        $block->config->set('text', 'نعمل بروح الالتزام والاحتراف لتقديم منتجات وخدمات عالية الجودة تلبي احتياجات العملاء وتواكب تطورات السوق. نسعى لبناء علاقات طويلة الأمد قائمة على الثقة والمصداقية، ونؤمن أن رضى العميل هو أساس نجاحنا واستمرارنا، لذا نحرص على التطوير المستمر وتقديم قيمة حقيقية في كل ما نقدمه.');

        //  نسعى لتقديم منتجات وخدمات عالية الجودة تلبي احتياجات عملائنا وتواكب تطورات السوق. نؤمن بأن النجاح يقوم على الالتزام، والمصداقية، والابتكار المستمر، لذلك نحرص على بناء علاقة طويلة الأمد مع عملائنا وشركائنا تقوم على الثقة والاحترام المتبادل. يعمل فريقنا بروح واحدة لتقديم تجربة مميزة تضمن رضا العميل في كل مرحلة، من جودة المنتج إلى سرعة الخدمة والدعم المستمر. رؤيتنا أن نكون نموذجًا في الكفاءة والاحترافية، ورسالتنا المساهمة في تطوير السوق المحلي وتعزيز مفهوم العمل التجاري القائم على الجودة والمسؤولية.
        $block->save();
    }
   
    public function createCtaBlock()
    {
        $block = new Block();
        $block->tenant_id = $this->tenant->id;
        $block->active = true;
        $block->name = 'cta';
        $block->save();

        // links 
        $contactLink = new Link();
        $contactLink->tenant_id = $this->tenant->id;
        $contactLink->block_id = $block->id;
        $contactLink->active = true;
        $contactLink->name = 'contact';
        $contactLink->slug = 'contact';
        $contactLink->link = $this->tenant->user->email  ;
        $contactLink->type = 'cta';
        $contactLink->meta = [
            'subject' => 'Contact from website',
        ];
        $contactLink->save();

        $subscriptionLink = new Link();
        $subscriptionLink->tenant_id = $this->tenant->id;
        $subscriptionLink->block_id = $block->id;
        $subscriptionLink->active = false;
        $subscriptionLink->name = 'subscription';
        $subscriptionLink->slug = 'subscription';
        $subscriptionLink->link = '';
        $subscriptionLink->type = 'cta';
        $subscriptionLink->sort = 3;
        $subscriptionLink->save();
 
    }
   

    public function createReviewsBlock()
    {
        $block = new Block();
        $block->tenant_id = $this->tenant->id;
        $block->active = true;
        $block->name = 'reviews';
        $block->save();

        $review = new Review();
        $review->tenant_id = $this->tenant->id;
        $review->block_id = $block->id;
        $review->active = true;
        $review->client_name = 'علي العمري';
        $review->client_email = 'exampleReview@gmail.com';
        $review->client_phone = '0512345678';
        $review->score = 5;
        $review->review_text = 'جودة الخدمات تفوق التوقعات، والتعامل احترافي وسريع من بداية الطلب حتى التسليم. فريق العمل متعاون ويهتم بأدق التفاصيل. أنصح الجميع بالتعامل معكم، فعلاً نموذج يُحتذى في المصداقية والجودة.';
        $review->sort = 1;
        $review->save();
    }

    public function createFaqBlock()
    {
        $block = new Block();
        $block->tenant_id = $this->tenant->id;
        $block->active = true;
        $block->name = 'faq';
        $block->config->set('title', 'الأسئلة الشائعة');
        $block->config->set('subtitle', 'هنا قائمة بإجاباتنا على أكثر الأسئلة تكراراً، إذا لم تجد إجابة لسؤالك تواصل معنا في أي وقت.');
        $block->config->set('faqs', [
            [
                'active' => true,
                'question' => 'ما نوع المنتجات أو الخدمات التي تقدمونها؟',
                'answer' => 'نقدم مجموعة متنوعة من المنتجات والخدمات التجارية التي تلبي احتياجات الأفراد والشركات، مع الحرص على الجودة العالية والمعايير الاحترافية في كل ما نقدمه.',
            ],
            [
                'active' => true,
                'question' => 'كيف يمكنني طلب منتج أو خدمة؟',
                'answer' => 'يمكنك الشراء من خلال موقعنا الإلكتروني أو من خلال الاتصال بنا للحصول على المزيد من المعلومات.',
            ],
            [
                'active' => true,
                'question' => 'هل توفرون خدمة التوصيل؟',
                'answer' => 'نعم، نوفر خدمة التوصيل داخل وخارج المدينة حسب نوع الطلب والموقع، مع ضمان سرعة التسليم وسلامة المنتج.',
            ],
            [
                'active' => true,
                'question' => 'ما طرق الدفع المتاحة؟',
                'answer' => 'نقبل عدة طرق دفع تشمل التحويل البنكي، الدفع الإلكتروني، والدفع عند الاستلام في بعض الحالات.',
            ],
            [
                'active' => true,
                'question' => 'هل يمكن استرجاع أو استبدال المنتج؟',
                'answer' => 'نعم، يمكن استرجاع أو استبدال المنتجات وفقًا لسياسة الاسترجاع الخاصة بنا، بشرط أن يكون المنتج في حالته الأصلية وضمن الفترة المحددة.',
            ],
            [
                'active' => true,
                'question' => 'كيف يمكنني التواصل معكم؟',
                'answer' => 'يمكنك التواصل معنا عبر قنواتنا الرسمية مثل رقم الجوال، البريد الإلكتروني، أو من خلال نموذج “اتصل بنا” في الموقع الإلكتروني، وسنكون سعداء بخدمتك في أي وقت.',
            ],
        ]);
        $block->save();
    }

    public function createFeaturesBlock()
    {
        $block = new Block();
        $block->tenant_id = $this->tenant->id;
        $block->active = true;
        $block->name = 'features';
        $block->config->set('title', 'المزايا الرئيسية');
        $block->config->set('subtitle', 'نحن نقدم خدمات متكاملة لعملائنا بجودة عالية وبأسعار مناسبة.');
        $block->config->set('features', [
            [
                'active' => true,
                'icon' => '🚀',
                'title' => 'جودة لا تضاهى',
                'description' => 'منتجاتنا وخدماتنا مصممة بأعلى معايير الجودة لتمنحك تجربة استثنائية وتفوق توقعاتك.',
            ],
            [
                'active' => true,
                'icon' => '🔥',
                'title' => 'الالتزام الدائم',
                'description' => 'نسلم جميع الطلبات في الوقت المحدد، لأن وقتك قيمة ونحن نحترمه.',
            ],
            [
                'active' => true,
                'icon' => '💰',
                'title' => 'قيمة حقيقية',
                'description' => 'نقدم أفضل الأسعار مقابل أعلى مستوى من الجودة، لتستمتع بخدمة اقتصادية وموثوقة.',
            ],
            [
                'active' => true,
                'icon' => '💚',
                'title' => 'خدمة عملاء من القلب',
                'description' => 'فريقنا موجود دائمًا للاستماع لك، والإجابة عن استفساراتك، وحل أي مشكلة بسرعة واحترافية.',
            ],
        ]);
        $block->save();


    }

    public function createLinksBlock()
    {
        $block = new Block();
        $block->tenant_id = $this->tenant->id;
        $block->active = true;
        $block->name = 'links';
        $block->save();

        $link = new Link();
        $link->tenant_id = $this->tenant->id;
        $link->block_id = $block->id;
        $link->active = true;
        $link->name = 'instagram';
        $link->slug = 'instagram';
        $link->link = 'https://www.instagram.com/'.$this->tenant->handle;
        $link->type = 'link';
        $link->meta = [
            'network' => 'instagram',
        ];
        $link->save();

        $link = new Link();
        $link->tenant_id = $this->tenant->id;
        $link->block_id = $block->id;
        $link->active = true;
        $link->name = 'x';
        $link->slug = 'x';
        $link->link = 'https://x.com/'.$this->tenant->handle;
        $link->type = 'link';
        $link->meta = [
            'network' => 'x',
        ];
        $link->save();
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
